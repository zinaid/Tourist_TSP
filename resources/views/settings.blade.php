<!DOCTYPE html>
<html>
<head>
    <title>TSP</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="{{ asset('css/settings.css') }}" rel="stylesheet">
</head>

<body>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyARDX6U-QGrtp9nfV0BAdbt6bgcDJZ_0zc&libraries=places&callback=initMap" async defer>
    </script>

    <div class="col-xs-12" style="text-align:center;">
        <div class="container">
 
            <form class="well form-horizontal" action="/podesavanje" method="post" id="contact_form">
                @csrf

                <!-- Form Name -->
                <legend>Settings</legend>
                <!-- radio checks -->
                @foreach($settings as $settings)
                <div class="form-group">
                    <label class="col-md-4 control-label">Travel Mode</label>
                    <div class="col-sm-12">
                        <div class="radio">
                            <label>
                                <i class="fas fa-car" aria-hidden="true" style="color:#595959;font-size:25px;"></i>
                                <div class="roundedOne">

                                    <input type="radio" value="0" name="travel_mode" <?php if ($settings->travel_mode == 0) echo 'checked="checked"'; ?>>
                                    <label for="travel_mode"></label>
                                </div>

                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <i class="fas fa-bicycle" aria-hidden="true" style="color:#595959;font-size:25px;"></i>
                                <div class="roundedOne">

                                    <input type="radio" value="1" name="travel_mode" <?php if ($settings->travel_mode == 1) echo 'checked="checked"'; ?>>
                                    <label for="travel_mode"></label>
                                </div>

                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <i class="fas fa-walking" aria-hidden="true" style="color:#595959;font-size:25px;"></i>
                                <div class="roundedOne">

                                    <input type="radio" value="2" name="travel_mode" <?php if ($settings->travel_mode == 2) echo 'checked="checked"'; ?>>
                                    <label for="travel_mode"></label>
                                </div>

                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group" style="display:none;">
                    <label class="col-md-4 control-label">Avoid Higways</label>
                    <div class="col-md-4 selectContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fas fa-road" aria-hidden="true" style="color:#595959;"></i></span>
                            <select class="form-control selectpicker" name="avoid_mode" id="avoid_mode">
                                <option value=" ">Please select your state</option>
                                <option value="1" <?php if ($settings->avoid_highways == 1) echo "selected"; ?>>YES</option>
                                <option value="0" <?php if ($settings->avoid_highways == 0) echo "selected"; ?>>NO</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Select Basic -->

                <div class="form-group">
                    <label class="col-md-4 control-label">Population Size</label>
                    <div class="col-md-4 selectContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fas fa-users" aria-hidden="true" style="color:#595959;"></i></span>
                            <select class="form-control selectpicker" name="population" id="population-size">
                                <option value=" ">Please select your state</option>
                                <option value="5" <?php if ($settings->population_size == 5) echo "selected"; ?>>5</option>
                                <option value="10" <?php if ($settings->population_size == 10) echo "selected"; ?>>10</option>
                                <option value="20" <?php if ($settings->population_size == 20) echo "selected"; ?>>20</option>
                                <option value="50" <?php if ($settings->population_size == 50) echo "selected"; ?>>50</option>
                                <option value="100" <?php if ($settings->population_size == 100) echo "selected"; ?>>100</option>
                                <option value="200" <?php if ($settings->population_size == 200) echo "selected"; ?>>200</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Mutation Rate:</label>
                    <div class="col-md-4 selectContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fas fa-dna" aria-hidden="true" style="color:#595959;"></i></span>
                            <select class="form-control selectpicker" name="mutation" id="mutation-rate">
                                <option value=" ">Please select your state</option>
                                <option value="0.00" <?php if ($settings->mutation_rate == 0.00) echo "selected"; ?>>0.00</option>
                                <option value="0.01" <?php if ($settings->mutation_rate == 0.01) echo "selected"; ?>>0.01</option>
                                <option value="0.05" <?php if ($settings->mutation_rate == 0.05) echo "selected"; ?>>0.05</option>
                                <option value="0.1" <?php if ($settings->mutation_rate == 0.1) echo "selected"; ?>>0.1</option>
                                <option value="0.2" <?php if ($settings->mutation_rate == 0.2) echo "selected"; ?>>0.2</option>
                                <option value="0.4" <?php if ($settings->mutation_rate == 0.4) echo "selected"; ?>>0.4</option>
                                <option value="0.7" <?php if ($settings->mutation_rate == 0.7) echo "selected"; ?>>0.7</option>
                                <option value="1" <?php if ($settings->mutation_rate == 1) echo "selected"; ?>>1.0</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Crossover Rate:</label>
                    <div class="col-md-4 selectContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fas fa-exchange-alt" aria-hidden="true" style="color:#595959;"></i></span>
                            <select class="form-control selectpicker" name="crossover" id="crossover-rate">
                                <option value=" ">Please select your state</option>
                                <option value="0.0" <?php if ($settings->crossover_rate == 0.0) echo "selected"; ?>>0.0</option>
                                <option value="0.1" <?php if ($settings->crossover_rate == 0.1) echo "selected"; ?>>0.1</option>
                                <option value="0.2" <?php if ($settings->crossover_rate == 0.2) echo "selected"; ?>>0.2</option>
                                <option value="0.3" <?php if ($settings->crossover_rate == 0.3) echo "selected"; ?>>0.3</option>
                                <option value="0.4" <?php if ($settings->crossover_rate == 0.4) echo "selected"; ?>>0.4</option>
                                <option value="0.5" <?php if ($settings->crossover_rate == 0.5) echo "selected"; ?>>0.5</option>
                                <option value="0.6" <?php if ($settings->crossover_rate == 0.6) echo "selected"; ?>>0.6</option>
                                <option value="0.7" <?php if ($settings->crossover_rate == 0.7) echo "selected"; ?>>0.7</option>
                                <option value="0.8" <?php if ($settings->crossover_rate == 0.8) echo "selected"; ?>>0.8</option>
                                <option value="0.9" <?php if ($settings->crossover_rate == 0.9) echo "selected"; ?>>0.9</option>
                                <option value="1" <?php if ($settings->crossover_rate == 1) echo "selected"; ?>>1.0</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Elitism:</label>
                    <div class="col-md-4 selectContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fas fa-trophy" aria-hidden="true" style="color:#595959;"></i></span>
                            <select class="form-control selectpicker" name="elitism" id="elitism">
                                <option value=" ">Please select your state</option>
                                <option value="1" <?php if ($settings->elitism == 1) echo "selected"; ?>>Enabled</option>
                                <option value="0" <?php if ($settings->elitism == 0) echo "selected"; ?>>Disabled</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Max Generations:</label>
                    <div class="col-md-4 selectContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fas fa-users" aria-hidden="true" style="color:#595959;"></i></span>
                            <select class="form-control selectpicker" name="generation" id="generations">
                                <option value="20" <?php if ($settings->max_generations == 20) echo "selected"; ?>>20</option>
                                <option value="50" <?php if ($settings->max_generations == 50) echo "selected"; ?>>50</option>
                                <option value="100" <?php if ($settings->max_generations == 100) echo "selected"; ?>>100</option>
                            </select>
                        </div>
                    </div>
                </div>
                @endforeach
            </form>
        </div>
    </div>
    <!-- /.container -->
    <div class="app-bar-bottom" style="z-index:3;">
        <!-- LISTA -->
        <div class="left_footer">
            <button style="display:none;" class="navbar-toggler closebtn_list" onclick="closeList()" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <i class="fa fa-times" aria-hidden="true" style="color:#595959;font-size:30px;"></i>
            </button>
            <a href="/back">
                <button class="navbar-toggler back_route" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <i class="fas fa-reply" aria-hidden="true" style="position:absolute;color:#595959;font-size:30px;"></i>
                </button>
            </a>
        </div>
        <!-- TUTORIAL -->
        <div class="right_footer">
            <button class="navbar-toggler tutorial" onclick="tutorial()" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <i class="fa fa-info" aria-hidden="true" style="color:#595959;font-size:30px;"></i>
            </button>
        </div>

        <!-- DUGME ZA SPREMANJE LISTE -->
        <div class="dugme">
            <div class="btn__content" id="confirmer">
                <button form="contact_form" style="all: unset;position: absolute;z-index: 1; border:none;background:transparent!important;" type="submit"><i class="far fa-paper-plane" style="color:#595959;font-size:30px;font-weight:bold;"></i>
                    <button>
            </div>
        </div>
    </div>
    <div id="mySidebar" class="sidebar">
        <i class="fa fa-times" onclick="closeNav()" aria-hidden="true" style="position:absolute;top:10px;right:10px;color:white;font-size:30px;"></i>
        <a href="/back"><i class="fa fa-home" aria-hidden="true"></i><p style="font-size:20px;">Home</p> </a>
        <a href="/settings"><i class="fa fa-cog" aria-hidden="true"></i> <p style="font-size:20px;">Settings</p> </a>
        <a href="#"><i class="fa fa-language" aria-hidden="true"></i><p style="font-size:20px;">Languages</p> </a>
        <a href="#"><i class="fa fa-info-circle" aria-hidden="true"></i><p style="font-size:20px;">Tutorial</p> </a>
    </div>
</body>

</html>