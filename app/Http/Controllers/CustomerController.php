<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

use Barryvdh\DomPDF\Facade\Pdf;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $recentOrders = Order::where('customer_email', $user->email)
            ->orderByDesc('created_at')
            ->take(5)
            ->get();
            
        return view('customer.dashboard', compact('user', 'recentOrders'));
    }

    public function orders()
    {
        $user = Auth::user();
        $orders = Order::where('customer_email', $user->email)
            ->orderByDesc('created_at')
            ->paginate(10);
            
        return view('customer.orders', compact('orders'));
    }

    public function orderDetail(Order $order)
    {
        if ($order->customer_email !== Auth::user()->email) {
            abort(403);
        }
        
        $order->load('items');
        
        return view('customer.order-detail', compact('order'));
    }

    public function downloadInvoice(Order $order)
    {
        if ($order->customer_email !== Auth::user()->email) {
            abort(403);
        }

        $order->load('items');
        $pdf = Pdf::loadView('pdf.invoice', compact('order'));
        
        return $pdf->download('invoice-' . $order->order_number . '.pdf');
    }

    public function address()
    {
        $user = Auth::user();
        return view('customer.address', compact('user'));
    }

    public function updateAddress(Request $request)
    {
        $user = Auth::user();
        
        $data = $request->validate([
            'phone' => ['nullable', 'string', 'max:50'],
            'address_line1' => ['required', 'string', 'max:255'],
            'address_line2' => ['nullable', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'state' => ['required', 'string', 'max:100'],
            'postal_code' => ['required', 'string', 'max:20'],
            'country' => ['required', 'string', 'max:100'],
        ]);

        $user->update($data);

        return redirect()->route('customer.address')->with('success', 'Address updated successfully.');
    }

    public function accountDetails()
    {
        $user = Auth::user();
        return view('customer.account-details', compact('user'));
    }

    public function updateAccountDetails(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'profile_image' => ['nullable', 'image', 'max:2048'],
        ]);

        // Construct full name
        $fullName = trim($data['first_name'] . ' ' . ($data['last_name'] ?? ''));

        $user->name = $fullName;
        $user->email = $data['email'];
        $user->phone = $data['phone'];

        if ($request->hasFile('profile_image')) {
            if ($user->profile_image) {
                $this->deleteImage($user->profile_image);
            }
            $user->profile_image = $this->storeImage($request->file('profile_image'), 'uploads/images', 'customer');
        }

        $user->save();

        return redirect()->route('customer.details')->with('success', 'Account information updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $user->password = Hash::make($data['password']);
        $user->save();

        return redirect()->route('customer.details')->with('success', 'Password updated successfully.');
    }

    private function storeImage(UploadedFile $file, string $folder, string $prefix): string
    {
        $extension = $file->getClientOriginalExtension() ?: 'jpg';
        $filename = $prefix . '-' . Str::lower(Str::random(12)) . '-' . time() . '.' . $extension;
        $targetDir = public_path($folder);

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0775, true);
        }

        $file->move($targetDir, $filename);

        return $folder . '/' . $filename;
    }

    private function deleteImage(?string $path): void
    {
        if (!$path) {
            return;
        }

        $fullPath = public_path($path);
        if (file_exists($fullPath)) {
            @unlink($fullPath);
            return;
        }

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
