<?php

namespace App\Http\Controllers\Api;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    /**
     * Search the products table.
     *
     * @param  Request $request
     * @return mixed
     */
    public function search(Request $request)
    {
        // First we define the error message we are going to show if no keywords
        // existed or if no results found.
        $error = ['error' => 'No results found, please try with different keywords.'];

        // Making sure the user entered a keyword.
        if($request->has('q')) {

            // Using the Laravel Scout syntax to search the products table.
            $contacts = Contact::search($request->get('q'))->get();

            // If there are results return them, if none, return the error message.
            return $contacts->count() ? $contacts : $error;

        }

        // Return the error message if no keywords existed
        return $error;
    }

    /**
     * Search the products table.
     *
     * @param  Request $request
     * @return mixed
     */
    public function autocomplete(Request $request)
    {
        // First we define the error message we are going to show if no keywords
        // existed or if no results found.
        $error = ['error' => 'No results found, please try with different keywords.'];

        // Making sure the user entered a keyword.
        if($request->has('search')) {

            // Using the Laravel Scout syntax to search the products table.
            $contacts = Contact::search($request->get('search'))->get();
//            $response = array();
//            foreach($contacts as $contact){
//                $response[] = array("value"=>$contact->id,"label"=>$contact->name);
//            }
//
//            echo json_encode($response);
//            exit;
            // If there are results return them, if none, return the error message.
            return $contacts->count() ? $contacts : $error;

        }

        // Return the error message if no keywords existed
        return $error;
    }
}
