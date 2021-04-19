@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading"><h2>Notifications</h2></div>
        <table class="table table-bordered text-center">
            <thead> 
                <tr> 
                    <th class="text-center">From:</th> 
                    <th class="text-center">Message</th> 
                    <th class="text-center">Mark as read</th> 
                </tr> 
            </thead> 
            <tbody> 
                <div class="notification">
                    <tr> 
                        <td>Sample Shop name</td> 
                        <td>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sint quia dolorum ut sit...</td> 
                        <td>
                            <button class="btn btn-default form-control">
                            <i class="fa fa-check"></i>
                            </button>
                        </td> 
                        </tr> 
                </div>
            </tbody> 
        </table>
    </div>
    <nav aria-label="...">
        <ul class="pager">
            <li class="disabled"><a href="#">Previous</a></li>
            <li class="disabled"><a href="#">Next</a></li>
        </ul>
    </nav>
@endsection