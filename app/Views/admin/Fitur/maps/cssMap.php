<script src="<?= base_url('leaflet/leaflet.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('leaflet/leaflet.css') ?>"/>

<!-- dataPeta css -->
<link rel="stylesheet" href="<?= base_url('random/css/maps.css') ?>">

<!-- JvectorMap -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqvmap/1.5.1/jqvmap.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <!-- MASTER PORTAL -->    
    <link href="portal-master/plugins/slick-carousel/slick/slick.css" rel="stylesheet">
    <link href="portal-master/plugins/slick-carousel/slick/slick-theme.css" rel="stylesheet">
    <link href="portal-master/plugins/fancybox/jquery.fancybox.pack.css" rel="stylesheet">
    <link href="portal-master/plugins/jquery-nice-select/css/nice-select.css" rel="stylesheet">
    <link rel="stylesheet" href="portal-master/css/gaya.css">
  
  <!-- FA -->    
  <script src="https://kit.fontawesome.com/a6d674fa0d.js" crossorigin="anonymous"></script>

    <!-- GIS -->  
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
  integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
  crossorigin=""/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.css"/>
  <link rel="stylesheet" href="lefgeo/src/leaflet.groupedlayercontrol.css" />

    <style>
        /* #maps {
            height: 500px;
        }
        .info {
            padding: 6px 8px;
            font: 14px/16px Arial, Helvetica, sans-serif;
            background: white;
            background: rgba(255,255,255,0.8);
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            border-radius: 5px;
        }
        .info h4 {
            margin: 0 0 5px;
            color: #777;
        }

        .legend {
            line-height: 18px;
            color: #555;
        }
        .legend i {
            width: 18px;
            height: 18px;
            float: left;
            margin-right: 8px;
            opacity: 0.7;
        } */

#maps {
    height: 86vh;
}

.penaldo{
    z-index: 999;
    position:relative;
    height: 500px;
    width: 500px;
}

.infos {
    padding: 6px 8px;
    font: 14px/16px Arial, Helvetica, sans-serif;
    background: white;
    background: rgba(255,255,255,0.8);
    box-shadow: 0 0 15px rgba(0,0,0,0.2);
    border-radius: 5px;
    /* width:200px; */
}
.infos h4 {
    margin: 0 0 5px;
    color: #777;
}
.legends {
    line-height: 18px;
    color: #555;
    margin-bottom: 10px;
    height: 185px;
    overflow: scroll;
}
.legends i {
    width: 18px;
    height: 18px;
    float: left;
    margin-right: 8px;
}

.pati{
    width: 250px;
    padding: 6px 8px;
}
    </style>