@extends('layouts.app')

@section('content')

<div class="container">
<style>
button .large-btn{
	background: #41295a;
    color: white;
    height: 23px;
    border: none;
    border-radius: 10px;
}
</style>
    <div class="row justify-content-center">
        <div class="col-md-8" style="padding:0px;">
            <div class="card">
                <div class="card-body">    
					<div>
						<div id="map-canvas" style="width:100%; height:750px;z-index:1;"></div>
						<div class="hr vpad"></div>
					<div></div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends("layouts.footer")
