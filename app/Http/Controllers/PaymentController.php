<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Ticket;


class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Récupérez toutes les transactions de paiement depuis la base de données
        $payments = Payment::all();

        // Chargez la vue 'payments.index' en passant les transactions comme données.
        return view('Payment.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return view('Payment.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {

    //     $payments = Payment::create($request->all());

    //     /*$product = new Product([
    //         "name" => $request->get('name'),
    //         "description" => $request->get('description'),
    //         "price" => $request->get('price'),
    //         "stock" => $request->get('stock'),
    //     ]);*/


    //     return redirect()->route('payments.index');
    // }
    public function store(Request $request)
    {
        $request->validate([
            'Card_Security_Code' => 'required|numeric|digits:3',
            // Exige un code de sécurité à 3 chiffres
            'Cardholder_Name' => 'required|string|max:255|regex:/^[a-zA-Z0-9\s]+$/',
            // Exige un nom de titulaire de carte de crédit
            'Card_Number' => 'required|numeric|digits:16',
            // Exige un numéro de carte de crédit à 16 chiffres
            'Card_Expiration_Date' => 'required|date|after_or_equal:today',
            // Exige une date d'expiration valide dans le futur
            'Address' => 'required|string',
            // Exige une adresse sous forme de chaîne
            'payment_method' => 'required|in:Credit Card,PayPal,Bank Transfer',
            // Exige que la méthode de paiement soit l'une des options spécifiées (Crédit, PayPal, Virement bancaire)



        ]);


        $payment = Payment::create(
            $request->all()
        );
        $payment->save();



        return redirect()->route('payments.index');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment = Payment::find($id);
        return view('Payment.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $payment = Payment::find($id);

        $payment->Card_Security_Code = $request->Card_Security_Code;
        $payment->payment_method = $request->payment_method;
        $payment->Cardholder_Name = $request->Cardholder_Name;
        $payment->Card_Expiration_Date = $request->Card_Expiration_Date;
        $payment->Address = $request->Address;

        $payment->save();

        return redirect()->route('payments.index')
            ->with('success', 'Payment Has Been updated successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //$product = Product::find($id) ;
        return view('Payment.show', compact('payment'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment = Payment::find($id);
        $payment->delete();
        return redirect()->route('payments.index')
            ->with('success', 'Payment deleted successfully');

    }


}
