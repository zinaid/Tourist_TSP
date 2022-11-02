<style>
.tutorial{
		  font-size:30px;
		  position:absolute;
		  color:white;
		  left:20px;
		  top:10px;
		  background:none;
		  border:none;
	  }
	   .back_route{
		  font-size:30px;
		  position:absolute;
		  color:#41295a;
		  right:40px;
		  top:10px;
		  background:none;
		  border:none;
	  }
</style>
<div class="app-bar-bottom" style="z-index:3;">
<!-- LISTA -->
<div class="left_footer">
	<a href="/back"><button class="navbar-toggler back_route" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
		<i class="fas fa-reply" aria-hidden="true" style="position:absolute;color:#595959;font-size:30px;"></i>
	</button></a>
</div>
<!-- TUTORIAL -->
<div class="right_footer">
	<button class="navbar-toggler tutorial"  onclick="tutorial()" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
		<i class="fa fa-info" aria-hidden="true" style="color:#595959;font-size:30px;position:absolute;"></i>
		
	</button>
</div>

<!-- DUGME ZA SPREMANJE LISTE -->
 <div class="dugme" id="find-route">
	<div class="btn__content" id="confirmer">
	  <a><i class="far fa-play-circle" style="color:#595959!important;font-size:50px;font-weight:bold;"></i></a>
	</div>  
</div>
</div>

