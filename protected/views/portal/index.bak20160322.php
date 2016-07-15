<style>
    html,
    body {
        margin: 0;
        padding: 0;
        background: #424242;
    }
    .tiles {
        font-family: Helvetica, Arial, 'DejaVu Sans', 'Liberation Sans', Freesans, sans-serif;
        font-size: 16px;
    }
    .tiles .tile {
        position: relative;
        cursor: pointer;
        margin: 5px;
        padding: 5px 15px;
        float: left;
        overflow: hidden;
    }
    .tiles .tile.lg-tile {
        height: 390px;
        width: 390px;
    }
    .tiles .tile.lg-tile .tile-caption {
        top: 351px;
    }
    .tiles .tile.sm-tile {
        height: 190px;
        width: 190px;
    }
    .tiles .tile.sm-tile .tile-caption {
        top: 151px;
    }
    .tiles .tile.md-tile {
        height: 190px;
        width: 390px;
    }
    .tiles .tile.md-tile .tile-caption {
        top: 151px;
    }
    .tiles .tile.md2-tile {
        height: 190px;
        //width: 590px;
        width: 671px;
    }
    .tiles .tile.md2-tile .tile-caption {
        top: 151px;
    }
    .tiles .tile .tile-caption {
        position: absolute;
        left: 0;
        padding: 0 10px 5px 10px;
        color: #fff;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
        -moz-transition: ease-in-out 0.3s;
        -o-transition: ease-in-out 0.3s;
        -webkit-transition: ease-in-out 0.3s;
        transition: ease-in-out 0.3s;
    }
    .tiles .tile .tile-caption header {
        height: 40px;
        line-height: 40px;
        border-bottom: 1px solid #fff;
    }
    .tiles .tile .tile-caption .tile-arrow-up {
        float: right;
        line-height: 40px;
        color: rgba(255, 255, 255, 0.8);
        -moz-transition: ease-in-out 0.3s;
        -o-transition: ease-in-out 0.3s;
        -webkit-transition: ease-in-out 0.3s;
        transition: ease-in-out 0.3s;
    }
    .tiles .tile .tile-caption:hover {
        top: 0;
    }
    .tiles .tile .tile-caption:hover .tile-content {
        top: 25px;
    }
    .tiles .tile .tile-caption:hover .tile-arrow-up {
        opacity: 0;
    }
    .tiles .tile .tile-content {
        position: absolute;
        background: rgba(0, 0, 0, 0.2);
        padding: 5px 10px;
        height: 100%;
        width: 100%;
        top: 150px;
        left: 0;
        -moz-transition: ease-in-out 0.3s;
        -o-transition: ease-in-out 0.3s;
        -webkit-transition: ease-in-out 0.3s;
        transition: ease-in-out 0.3s;
    }
    .tiles .tile:active {
        box-shadow: rgba(0, 0, 0, 0.5) 0 0 5px 1px;
    }
    .tile-row {
        display: inline-block;
    }
    .bg-blue {
        background: #428bca;
        color: #fff;
    }
    .bg-light-blue {
        background: #5bc0de;
        color: #fff;
    }
    .bg-green {
        background: #5cb85c;
        color: #fff;
    }
    .bg-orange {
        background: #f0ad4e;
        color: #fff;
    }
    .bg-red {
        background: #d9534f;
        color: #fff;
    }
    .bg-image {
        background: url('http://lorempixel.com/190/190/business/5/');
    }

</style>

<center>
    <br><br>
    <h2>Selamat Datang ke </h2>
    <h1>Sistem Warta Persekutuan dan Perundangan Malaysia</h1>
    Klik di <a href="index.php?r=login/index" target="_blank">sini</a> untuk ke bahagian CMS
</center>


<h2>Normal grid</h2>

<!--<div class="row">
<div class="col-md-8">
    <div class="tiles">Slider</div>
</div>
<div class="col-md-4">Highlight</div>
</div>-->

<div class="container">

  <div class="tiles">

    <div class="tile-row">
      <div class="lg-tile tile bg-red">
        <div class="tile-caption">
          <header>
            Lorem Ipsum
            <span class="glyphicon glyphicon-collapse-up tile-arrow-up"></span>
          </header>
          Fusce vel sapien elit in malesuada semper mi.
        </div>
      </div>

      
      <div class="sm-tile tile bg-orange">
        <div class="tile-caption">
          <header>
            Lorem Ipsum
            <span class="glyphicon glyphicon-collapse-up tile-arrow-up"></span>
          </header>
          Fusce vel sapien elit in malesuada semper mi.
        </div>
      </div>
      
      <div class="sm-tile tile bg-light-blue">
        <div class="tile-caption">
          <header>
            Lorem Ipsum
            <span class="glyphicon glyphicon-collapse-up tile-arrow-up"></span>
          </header>
          Fusce vel sapien elit in malesuada semper mi.
        </div>
      </div>
      
      <div class="md-tile tile bg-blue">
        <div class="tile-caption">
          <header>
            Lorem Ipsum
            <span class="glyphicon glyphicon-collapse-up tile-arrow-up"></span>
          </header>
          Fusce vel sapien elit in malesuada semper mi.
        </div>
      </div>

      <div class="sm-tile tile bg-image">
        <div class="tile-caption">
          <header>
            Lorem Ipsum
            <span class="glyphicon glyphicon-collapse-up tile-arrow-up"></span>
          </header>
          Fusce vel sapien elit in malesuada semper mi.
        </div>
      </div>

      <div class="sm-tile tile bg-light-blue">
        <div class="tile-caption">
          <header>
            Lorem Ipsum
            <span class="glyphicon glyphicon-collapse-up tile-arrow-up"></span>
          </header>
          Fusce vel sapien elit in malesuada semper mi.
        </div>
      </div>

      <a href="#lastone" class="md-tile tile bg-red">
        <div class="tile-caption">
          <header>
            Lorem Ipsum
            <span class="glyphicon glyphicon-collapse-up tile-arrow-up"></span>
          </header>
          Fusce vel sapien elit in malesuada semper mi.
        </div>
      </a>
    </div>

  </div>

</div>