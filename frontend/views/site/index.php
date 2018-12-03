<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'My Yii Application';
?>
<?php $image=Html::img('@web/images/face.jpg', ['alt'=>'face', 'class'=>'img-responsive text-center', 'style' => 'width:100%;']);?>
<style>
    #newProducts
    {
        background-image: url("../web/images/face.jpg");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        position: relative;
    }

    #newProducts .text
    {
        text-align: right;
        position: relative;
        bottom: 0%;
        left: 50%;

        color: white;
    }

    .imagesInside
    {
        object-fit: scale-down;
    }


</style>

<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome to FixByte!</h1>

        <div class="input-group" style="padding-top: 20px; padding-bottom: 20px;">
            <input type="text" class="form-control" placeholder="Search">
            <a href="www.google.com" class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></a>
        </div>

        <!-- https://getbootstrap.com/docs/3.3/javascript/#carousel -->

        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <br>
                <button class="btn btn-warning" type="submit">Take a look...</button>
            </ol>

            <div class="carousel-inner">
                <div class="item active">
                    <img class="imagesInside" src="../web/images/face.jpg" alt="Los Angeles">
                </div>

                <div class="item">
                    <img class="imagesInside" src="../web/images/face.jpg" alt="Chicago">
                </div>

                <div class="item">
                    <img class="imagesInside" src="../web/images/face.jpg" alt="New York">
                </div>
            </div>

            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        




        <!--
        <p class="lead">You have successfully created your Yii-powered application.</p>
        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
        -->


    </div>
    <div>
        <div class="row text-center">
            <div class="col-lg-12 col-md-12">
                <div class="col-lg-3 col-md-3">

                </div>
                <div class="col-lg-9 col-md-9">

                </div>
            </div>
            <div class="col-lg-3 col-md-3 table-bordered">
                <div class="col-lg-12 col-md-12">
                    <?php
                    //simple but ugly
                        /*foreach ($allCategories as $eachCategory)
                        {
                            echo $eachCategory->categoriaNome;
                            foreach ($allCategoryChilds as $eachCategoryChild)
                            {
                                if ($eachCategoryChild->categoria_idcategorias==$eachCategory->idcategorias)
                                {
                                    echo '<br>'.$eachCategoryChild->childNome.'<br>';
                                }
                            }
                        }*/


                    $i=0;
                    echo '
                          <div style="padding-top: 20px;">
                            <h4 class="thin">Categorias</h4>

                            <div class="text-left">
                                <input type="checkbox" name="vehicle1" value="Bike"checked> All<br>
                            </div>
                    ';

                    foreach ($allCategories as $eachCategory)
                    {
                        echo '                            <div class="text-left"><input type="checkbox" name="'.$eachCategory->categoriaNome.'" value="'.$eachCategory->categoriaNome.'"> '.$eachCategory->categoriaNome.'<br>';

                        foreach ($allCategoryChilds as $eachCategoryChild)
                        {
                            if ($eachCategoryChild->categoria_idcategorias==$eachCategory->idcategorias)
                            {
                                $i++;
                                if ($i<3)
                                {
                                    echo '
                                       <input style="margin-left: 25px;" type="checkbox" name="vehicle3" value="Boat"> '.$eachCategoryChild->childNome.'<br>
                                    ';
                                }
                                else
                                {
                                    echo '
                                          <div id="'.$eachCategory->categoriaNome.'" class="collapse">
                                            <!--<input type="checkbox" name="vehicle1" value="Bike">All<br>-->
                                            <input style="margin-left: 25px;" type="checkbox" name="vehicle3" value="Boat"> '.$eachCategoryChild->childNome.'<br>
                                          </div>
                                    ';
                                }
                            }
                            else
                            {
                                $i=0;
                            }
                        }

                        echo '</div><button style="margin-top: 10px;margin-bottom: 20px;" type="button" class="btn-group-sm btn-info" data-toggle="collapse" data-target="#'.$eachCategory->categoriaNome.'">Show more...</button><br>';
                    }

                    echo '
                                                
                            
                          </div>
                                              <div class="col-lg-12 col-md-12 text-center" style="padding-bottom: 20px;padding-top: 20px;">
                        <button class="btn btn-warning" type="submit" style="width: inherit">Apply</button>
                    </div>
                    ';






                        //nice way
                    echo '<!--
                          <div style="padding-top: 20px;">
                            <h4 class="thin">Categorias</h4>
                            <div class="text-left">
                                <input type="checkbox" name="vehicle1" value="Bike"checked> All<br>
                                
                                
                                <input type="checkbox" name="vehicle2" value="Car"> Componentes<br>
                                <input style="margin-left: 25px;" type="checkbox" name="vehicle3" value="Boat"> Intel<br>

                                <div id="moreOptionsBrand" class="collapse">
                                    <input type="checkbox" name="vehicle1" value="Bike">All<br>
                                    <input type="checkbox" name="vehicle2" value="Car"> Components<br>
                                    <input type="checkbox" name="vehicle3" value="Boat" checked>I have a boat<br>
                                </div>
                            </div>
                            <button style="margin-top: 10px;" type="button" class="btn-group-sm btn-info" data-toggle="collapse" data-target="#moreOptionsBrand">Show more...</button>
                          </div>
                    
                    
                    -->';

                    ?>

                    <!--
                    <h4 class="thin">Brands</h4>
                    <select class="form-control" name="tip_selector">
                        <option class="text-right" value="All" selected="">All</option>
                        <option value="Pay">Pay - Carregamento</option>
                        <option value="Win">Win - Jogo ganho</option>
                        <option value="Bet">Bet - Aposta</option>
                    </select>
                    -->

                </div>



                <!--
                <div class="col-lg-12 col-md-12">
                    <h4 class="thin">Categories</h4>
                    <select class="form-control" name="tip_selector">
                        <option class="text-right" value="All" selected="">All</option>
                        <option value="Pay">Pay - Carregamento</option>
                        <option value="Win">Win - Jogo ganho</option>
                        <option value="Bet">Bet - Aposta</option>
                    </select>
                </div>
                <div class="col-lg-12 col-md-12">
                    <h4 class="thin">Categories Child</h4>
                    <select class="form-control" name="tip_selector">
                        <option class="text-right" value="All" selected="">All</option>
                        <option value="Pay">Pay - Carregamento</option>
                        <option value="Win">Win - Jogo ganho</option>
                        <option value="Bet">Bet - Aposta</option>
                    </select>
                </div>
                -->


            </div>
            <!-- <div style="border-left:1px solid #000;height:500px"></div> -->
            <div class="col-lg-4.5 col-md-4.5">
                <div class="body-content">

                    <div class="row">
                        <?php
                            foreach ($allProducts as $eachProduct)
                            {
                                $path = Url::to(['produto/view', 'id' => $eachProduct->idprodutos]);

                                echo '
                                      <div class="col-lg-4 col-md-4 table-bordered">
                                        <h2>'.$eachProduct->produtoNome.'</h2>

                                        <div style="padding-left: 20px;">';
                                                for ($i=1;$i<=3;$i++)
                                                {
                                                    $description = 'produtoDescricao'.$i;
                                                    echo '<p>'.$eachProduct->$description.'</p>';
                                                }
                                                    echo'
                                        </div>

                                        <p class="col-lg-12 col-md-12">
                                            <div class="col-lg-6 col-md-6">
                                                <p>Price: '.$eachProduct->produtoPreco.'€</p>                                        
                                            </div>
                                            <div class="col-lg-6 col-md-6" style="padding-bottom: 15px">
                                                <a class="btn btn-default" href="'.$path.'">Take a look &raquo;</a>
                                            </div>
                                        </p>
                                      </div>
                                
                                
                                ';

                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--
    <div class="input-group">
        <div class="input-group-btn">
            <button tabindex="-1" class="btn btn-default" type="button">Select</button>
            <button tabindex="-1" data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button">
                <span class="caret"></span>
            </button>
            <ul role="menu" class="dropdown-menu">
                <li><a href="#">
                        <input type="checkbox"><span class="lbl"> Every day</span>
                    </a></li>
                <li class="divider"></li>
                <li><a href="#">
                        <input type="checkbox">
                        <span class="lbl"> Monday</span>
                    </a></li>
                <li><a href="#">
                        <input type="checkbox"><span class="lbl">
								Tuesday</span>
                    </a></li>
                <li><a href="#">
                        <input type="checkbox"><span class="lbl">
								Wednesday</span>
                    </a></li>
                <li><a href="#">
                        <input type="checkbox"><span class="lbl">
								Thursday</span>
                    </a></li>
                <li><a href="#">
                        <input type="checkbox"><span class="lbl">
								Friday</span>
                    </a></li>
                <li><a href="#">
                        <input type="checkbox"><span class="lbl">
								Saturday</span>
                    </a></li>
                <li><a href="#">
                        <input type="checkbox"><span class="lbl">
								Sunday</span>
                    </a></li>
                <li class="divider"></li>
                <li><a href="#">
                        <input type="checkbox"><span class="lbl"> Last Weekday in month</span>
                    </a></li>
            </ul>
        </div>
    </div>
    -->
</div>
