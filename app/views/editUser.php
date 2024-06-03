<?php

use app\helpers\Session;
use app\controllers\SignUpControler;
use app\models\RegisterModel;

require_once __DIR__ . './../helpers/Session.php';
$classes = ['Разред', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX'];
?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Basic form elements</h4>
                    <p class="card-description">
                    Basic form elements
                    </p>
                    <form class="forms-sample">
                        <div class="form-group">
                            <label for="exampleInputName1">Name</label>
                            <input name="fullname" type="text" class="form-control" id="exampleInputName1" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail3">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword4">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword4" placeholder="Password">
                        </div>
                        <div class="form-group row">
                            <label>Razrednik</label>
                            <div class="col-md-4">
                                <select name="class" class="form-control form-control-lg" id="exampleFormControlSelect2">
                                    <?php foreach ($classes as $class) { echo '<option value=' ."$class". ">{$class}<" .'/option>';} ?>
                                </select>
                            </div>
                            <div class="col-md-8 row">
                                <label>Odjeljenje</label>
                                <?php 
                                    $i = 1;
                                    while ($i <= 5)
                                    {
                                    echo '<div class="col-2"><input name="department[]" type="checkbox" class="form-check-input mx-1" value = ' . $i . '>' .$i . '</input></div>';
                                    $i++;
                                    }  
                                ?>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Save</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
            <!-- <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><?php echo Session::get('user'); ?></h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Ime i prezime</th>
                                <td>
                                    <div class="form-group">
                                        <input name="fullname" type="text" class="form-control" id="exampleInputName1" placeholder="Name">
                                    </div>
                                </td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th>E-mail</th>
                                <td>
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Email">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-danger">
                                    <th>Lozinka</th>
                                    <div class="form-group">
                                        <input type="password" class="form-control" id="exampleInputPassword4" placeholder="Password">
                                    </div>
                                </td>
                            </tr>
                            <tr>

                                <td></td>
                            </tr>
                            <tr>
                                <th>Razrednik</th>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> -->
        </div>
    </div>