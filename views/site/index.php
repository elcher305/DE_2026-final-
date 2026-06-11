<?php



$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Портал записи на консультацию "Дел.Нет"</h1>

        <p class="lead">Зарегистрируйсь, подайте заявку на
            консультацию по интересующему его вопросу.</p>

        <p><a class="btn btn-lg btn-success" href="views/consultation/index">Заказать консультацию</a></p>
    </div>

    <div class="body-content d-flex justify-content-center">
        <div id="carouselExampleAutoplaying" class="carousel slide"
             style="max-width: 800px;"
             data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouseExampleAutoplaying" data-bs-slide-to="0"
                        class="active" aria-current="true" aria-label="Slide 1">
                </button>
                <button type="button" data-bs-target="#carouseExampleAutoplaying" data-bs-slide-to="1"
                        aria-current="true" aria-label="Slide 2">
                </button>
                <button type="button" data-bs-target="#carouseExampleAutoplaying" data-bs-slide-to="2"
                        aria-current="true" aria-label="Slide 3">
                </button>
                <button type="button" data-bs-target="#carouseExampleAutoplaying" data-bs-slide-to="3"
                        aria-current="true" aria-label="Slide 4">
                </button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/i.webp" width="800" height="400"
                         style="object-fit: cover;"
                         class="d-block" alt="slide1">
                </div>

                <div class="carousel-item">
                    <img src="img/435463.jpg" width="800" height="400"
                         style="object-fit: cover;"
                         class="d-block" alt="slide2">
                </div>

                <div class="carousel-item">
                    <img src="img/123.jpg" width="800" height="400"
                         style="object-fit: cover;"
                         class="d-block" alt="slide3">
                </div>
                <div class="carousel-item">
                    <img src="img/maxresdefault.jpg" width="800" height="400"
                         style="object-fit: cover;"
                         class="d-block" alt="slide4">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-ride="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-ride="prev">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

      <footer
    </div>
</div>
