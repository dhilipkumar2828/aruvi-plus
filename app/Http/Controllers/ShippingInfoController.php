<?php

namespace App\Http\Controllers;

use App\Models\ShippingInfo;
use Illuminate\Http\Request;

class ShippingInfoController extends Controller
{
    public function index()
    {
        $shipping_infos = ShippingInfo::orderBy('id')->get();
        // Ensure there are at least 10 rows for initial display
        $count = $shipping_infos->count();
        if ($count < 10) {
            for ($i = 0; $i < (10 - $count); $i++) {
                ShippingInfo::create([
                    'from_amount' => 0,
                    'to_amount' => 0,
                    'shipping_charges_tn_py' => 0,
                    'discount_tn_py' => 0,
                    'shipping_charges_other' => 0,
                    'discount_other' => 0,
                ]);
            }
            $shipping_infos = ShippingInfo::orderBy('id')->get();
        }
        return view('admin.shipping-info', compact('shipping_infos'));
    }

    public function update(Request $request)
    {
        $data = $request->all();
        
        if (isset($data['shipping']) && is_array($data['shipping'])) {
            foreach ($data['shipping'] as $id => $values) {
                $shipping = ShippingInfo::find($id);
                if ($shipping) {
                    $shipping->update([
                        'from_amount' => (isset($values['from_amount']) && $values['from_amount'] !== '') ? $values['from_amount'] : 0,
                        'to_amount' => (isset($values['to_amount']) && $values['to_amount'] !== '') ? $values['to_amount'] : 0,
                        'shipping_charges_tn_py' => (isset($values['shipping_charges_tn_py']) && $values['shipping_charges_tn_py'] !== '') ? $values['shipping_charges_tn_py'] : 0,
                        'discount_tn_py' => (isset($values['discount_tn_py']) && $values['discount_tn_py'] !== '') ? $values['discount_tn_py'] : 0,
                        'shipping_charges_other' => (isset($values['shipping_charges_other']) && $values['shipping_charges_other'] !== '') ? $values['shipping_charges_other'] : 0,
                        'discount_other' => (isset($values['discount_other']) && $values['discount_other'] !== '') ? $values['discount_other'] : 0,
                    ]);
                }
            }
        }

        return back()->with('success', 'Shipping Information Updated Successfully!');
    }
}
