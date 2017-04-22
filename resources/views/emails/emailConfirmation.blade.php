@extends('emails.layouts.default')

<h4>{{$user->name}}&nbsp;您好:</h4>

@include('emails.partials._emailConfirmationContent')

@include('auth._companyInfo')