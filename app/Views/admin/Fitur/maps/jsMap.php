<script>
    // AMBIL DATA PHP
    var data = <?= json_encode($data) ?>;
    var nilaiMax = <?= $nilaiMax ?>;
    var warna = ['red','blue','green','yellow'];

    // MEMBUAT POLYGON DARI LAYER GROUP PER DAERAH
    var SENA = L.layerGroup();
    var SULI = L.layerGroup();
    var PATU = L.layerGroup();
    var SIUU = L.layerGroup();

    const SENA_HGU = L.layerGroup();
    const SULI_HGU = L.layerGroup();
    const PATU_HGU = L.layerGroup();

    // ==========================================================================================================
    $.getJSON("<?= base_url('source_hgu/sena.geojson') ?>", function(data){
            geoLayer = L.geoJson(data, {
                style: function(feature){
                    return{
                        opacity:1.0,
                        color: 'red',
                        fillColor: 'red'
                    }
                },
            }).addTo(SENA_HGU);
        })

    $.getJSON("<?= base_url('source_hgu/suli.geojson') ?>", function(data){
            geoLayer = L.geoJson(data, {
                style: function(feature){
                    return{
                        opacity:1.0,
                        color: 'red',
                        fillColor: 'red'
                    }
                },
            }).addTo(SULI_HGU);
        })

    $.getJSON("<?= base_url('source_hgu/patu.geojson') ?>", function(data){
            geoLayer = L.geoJson(data, {
                style: function(feature){
                    return{
                        opacity:1.0,
                        color: 'red',
                        fillColor: 'red'
                    }
                },
            }).addTo(PATU_HGU);
        })

        // =================================================================================================================================================
    // Google Satelite
    var googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
        attribution: 'Google Maps',
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
    });

    // MENAMPILKAN DATA-DATA KEBUN
    var MARKER = L.layerGroup();

    // MAP DASAR
    var map = L.map('maps', {
        center: [-3.9938767140252533, 104.67666756432517],
        zoom: 8,
        layers: [googleSat],
        attributionControl: false,
        fullscreenControl: true,
        fullscreenControlOptions: { // optional
            title: "fullscreen",
            titleCancel: "Exit fullscreen"
        }
    });

    // MENGATUR MARKER
    var markers = L.markerClusterGroup();

    for (var i = 0; i < data.length; i++) {
        var title = data[i][0].properties.blok_sap;
        for (let j = 0; j < data[i].length; j++) {
            var marker = L.marker(new L.LatLng(data[i][j].properties.st_y, data[i][j].properties.st_x), { title: title });
            markers.addLayer(marker);
            marker.bindPopup("blok : " + title);
        }
    }
    markers.addTo(MARKER);

    // BaseLayer
    var OpenStreetMap_Mapnik = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });

    var groupedOverlays = {
        "Map": {
            "Map Bumi": googleSat,
            "Map Biasa": OpenStreetMap_Mapnik
        },
        "Kebun": {
            "SENA": SENA,
            "SULI": SULI,
            "PATU": PATU,
        },
        "HGU": {
            "SENA": SENA_HGU,
            "SULI": SULI_HGU,
            "PATU": PATU_HGU,
        },
        "Marker": {
            "Marker": MARKER
        }
    };

    var basemaps = {};
    var options = {
        exclusiveGroups: ["Map"],
        groupCheckboxes: false
    };
    var layerControl = L.control.groupedLayers(basemaps, groupedOverlays, options);
    map.addControl(layerControl);

        //DEKLARASI TAHUN
        currentYear = new Date().getFullYear();

        function getColor(d) {
            return  d <= 0  ? '#fff' :
                    d <= (currentYear - 35) ? '#800026' :
                    d <= (currentYear - 30)  ? '#BD0026' :
                    d <= (currentYear - 25)  ? '#E31A1C' :
                    d <= (currentYear - 20)  ? '#FC4E2A' :
                    d <= (currentYear - 15)   ? '#FD8D3C' :
                    d <= (currentYear - 10)   ? '#FEB24C' :
                    d <= (currentYear - 5)  ? '#FED976' :
                                '#FFEDA0';
        }

        function style(feature){
                return{
                    weight : 2,
                    opacity : 1,
                    color : 'white',
                    dashArray : '3',
                    fillOpacity : 0.7,
                    fillColor : getColor(parseInt(feature.properties.tahuntanam))
                };
            }

        function highlightFeature(e) {
            var layer = e.target;

            layer.setStyle({
                weight: 5,
                color: '#FF4242',
                dashArray: '',
                fillOpacity: 0
            });

            if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
                layer.bringToFront();
            }

            info.update(layer.feature.properties);
        }

        function resetHighlight(e) {
            geojson.resetStyle(e.target);
            info.update();
        }

        function zoomToFeature(e) {
            map.fitBounds(e.target.getBounds().pad(0.6));
        }

        function onEachFeature(feature, layer) {
            layer.on({
                mouseover: highlightFeature,
                mouseout: resetHighlight,
                click: zoomToFeature
            });
        }

        // LEGEND
        var legend = L.control({
            position: 'bottomleft'
        });
        legend.onAdd = function(map) {

            var div = L.DomUtil.create('div', 'naruto infos legends'),
                grades = [(currentYear - 35), (currentYear - 30), (currentYear - 25), (currentYear - 20), (currentYear - 15), (currentYear - 10), (currentYear - 5)],
                labels = [];
            // loop through our density intervals and generate a label with a colored square for each interval
            div.innerHTML = "<h5>Tahun Tanam</h5>";
            for (var i = 0; i < grades.length; i++) {
                umura = currentYear - grades[i + 1] + 1;
                umur = currentYear - grades[i];

                if (Number.isNaN(umura)) {
                    umurr = "0-" + umur;
                } else if (umur > 30) {
                    umurr = umur + "+";
                } else {
                    umurr = umura + "-" + umur;
                }
                div.innerHTML +=
                    '<i style="background:' + getColor(grades[i] + 1) + '"></i> ' + umurr + " Tahun" + '<br>';
            }

            div.innerHTML +=
                '<i style="background:#ffff"></i> NO DATA<br>';


            return div;
        };
        legend.addTo(map);

        $.getJSON("<?= base_url('source_geojson/sena.geojson') ?>", function(data){
            geoLayer = L.geoJson(data, {
                style: style,
                onEachFeature: onEachFeature
            }).addTo(SENA);
        })

        $.getJSON("<?= base_url('source_geojson/suli.geojson') ?>", function(data){
            geoLayer = L.geoJson(data, {
                style: style,
                onEachFeature: onEachFeature
            }).addTo(SULI);
        })

        $.getJSON("<?= base_url('source_geojson/patu.geojson') ?>", function(data){
            geoLayer = L.geoJson(data, {
                style: style,
                onEachFeature: onEachFeature
            }).addTo(PATU);
        })
    
    var geojson = L.geoJson(data[2], {
            style: style,
            onEachFeature: onEachFeature
        }).addTo(SIUU);

        function getSelectValue(){
        var ambil = document.getElementById("pilihan").value;

        judul = '';
        satuan = '';
        arr = [];

        if(!(ambil === "tahuntanam")){
            max_num = 0;
            if(ambil === "luas_ha")
            {
                satuan = 'ha';
                judul = 'Luas';
                for (var i = 0; i < data.length; i++) {
                    for (let j = 0; j < data[i].length; j++) {
                        if(data[i][j].properties.luas_ha > max_num){
                            max_num = data[i][j].properties.luas_ha;
                        }
                    }
                }

                nilaiMax = max_num;
                function getColor(d) {
                    return d > (nilaiMax/8)*7 ? '#800026' :
                    d > (nilaiMax/8)*6  ? '#BD0026' :
                    d > (nilaiMax/8)*5  ? '#E31A1C' :
                    d > (nilaiMax/8)*4  ? '#FC4E2A' :
                    d > (nilaiMax/8)*3   ? '#FD8D3C' :
                    d > (nilaiMax/8)*2   ? '#FEB24C' :
                    d > (nilaiMax/8)*1   ? '#FED976' :
                                '#FFEDA0';
                }

                function style(feature){
                    return{
                        weight : 2,
                        opacity : 1,
                        color : 'white',
                        dashArray : '3',
                        fillOpacity : 0.7,
                        fillColor : getColor(parseInt(feature.properties.luas_ha))
                    };
                }
            }
            else if(ambil === "total_poko")
            {
                satuan = 'pohon';
                judul = 'Pohon';
                for (var i = 0; i < data.length; i++) {
                    for (let j = 0; j < data[i].length; j++) {
                        if(data[i][j].properties.total_poko > max_num){
                            max_num = data[i][j].properties.total_poko;
                        }
                    }
                }
                // console.log("ATAS : " + max_num);
                nilaiMax = max_num;
                function getColor(d) {
                    return d > (nilaiMax/8)*7 ? '#800026' :
                    d > (nilaiMax/8)*6  ? '#BD0026' :
                    d > (nilaiMax/8)*5  ? '#E31A1C' :
                    d > (nilaiMax/8)*4  ? '#FC4E2A' :
                    d > (nilaiMax/8)*3   ? '#FD8D3C' :
                    d > (nilaiMax/8)*2   ? '#FEB24C' :
                    d > (nilaiMax/8)*1   ? '#FED976' :
                                '#FFEDA0';
                }

                function style(feature){
                    return{
                        weight : 2,
                        opacity : 1,
                        color : 'white',
                        dashArray : '3',
                        fillOpacity : 0.7,
                        fillColor : getColor(parseInt(feature.properties.total_poko))
                    };
                }
            }
            else if(ambil === "pokok_per_")
            {
                satuan = '/meter';
                judul = 'per meter';
                for (var i = 0; i < data.length; i++) {
                    for (let j = 0; j < data[i].length; j++) {
                        arr.push(data[i][j].properties.pokok_per_);
                        if(data[i][j].properties.pokok_per_ > max_num){
                            max_num = data[i][j].properties.pokok_per_;
                        }
                    }
                }
                nilaiMax = max_num;
                function getColor(d) {
                    return d > (nilaiMax/8)*7 ? '#800026' :
                    d > (nilaiMax/8)*6  ? '#BD0026' :
                    d > (nilaiMax/8)*5  ? '#E31A1C' :
                    d > (nilaiMax/8)*4  ? '#FC4E2A' :
                    d > (nilaiMax/8)*3   ? '#FD8D3C' :
                    d > (nilaiMax/8)*2   ? '#FEB24C' :
                    d > (nilaiMax/8)*1   ? '#FED976' :
                                '#FFEDA0';
                }

                function style(feature){
                    return{
                        weight : 2,
                        opacity : 1,
                        color : 'white',
                        dashArray : '3',
                        fillOpacity : 0.7,
                        fillColor : getColor(parseInt(feature.properties.pokok_per_))
                    };
                }
            }

            function highlightFeature(e) {
                var layer = e.target;

                layer.setStyle({
                    weight: 5,
                    color: '#FF4242',
                    dashArray: '',
                    fillOpacity: 0
                });

                if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
                    layer.bringToFront();
                }

                info.update(layer.feature.properties);
            }

        function resetHighlight(e) {
            geojson.resetStyle(e.target);
            info.update();
        }

        function zoomToFeature(e) {
            map.fitBounds(e.target.getBounds().pad(0.6));
        }

        function onEachFeature(feature, layer) {
            layer.on({
                mouseover: highlightFeature,
                mouseout: resetHighlight,
                click: zoomToFeature
            });
        }

        // LEGEND
        var legend = L.control({
            position: 'bottomleft'
        });
        legend.onAdd = function(map) {
            var div = L.DomUtil.create('div', 'naruto infos legends'),
                grades = [parseInt(nilaiMax/8)*8, parseInt(nilaiMax/8)*7, parseInt(nilaiMax/8)*6, parseInt(nilaiMax/8)*5, parseInt(nilaiMax/8)*4, parseInt(nilaiMax/8)*3, parseInt(nilaiMax/8)*2],
                labels = [];
            // loop through our density intervals and generate a label with a colored square for each interval
            div.innerHTML = "<h5>Data " + judul + "</h5>";
            for (var i = 0; i < grades.length; i++) {
                umura = grades[i + 1] + 1;
                umur = grades[i];

                if (Number.isNaN(umura)) {
                    umurr = "0-" + umur;
                } else if (umur >= nilaiMax) {
                    umurr = umur + "+";
                } else {
                    umurr = umura + "-" + umur;
                }
                div.innerHTML +=
                    '<i style="background:' + getColor(grades[i] + 1) + '"></i>'+ umurr + ' ' + satuan + '<br>';
            }

            div.innerHTML +=
                '<i style="background:#ffff"></i> NO DATA<br>';

            return div;
        };
        legend.addTo(map);

    var geojson = L.geoJson(data[0], {
            style: style,
            onEachFeature: onEachFeature
        }).addTo(SENA);

    var geojson = L.geoJson(data[1], {
            style: style,
            onEachFeature: onEachFeature
        }).addTo(SULI);
    
    var geojson = L.geoJson(data[2], {
            style: style,
            onEachFeature: onEachFeature
        }).addTo(PATU);

    }
    else
    {
        arr = [];
        for (var i = 0; i < data.length; i++) {
                for (let j = 0; j < data[i].length; j++) {
                    if(data[i][j].properties.tahuntanam > max_num){
                        max_num = data[i][j].properties.tahuntanam;
                    }
                }
            }

        //DEKLARASI TAHUN
        currentYear = new Date().getFullYear();

        function getColor(d) {
            return  d <= 0  ? '#fff' :
                    d <= (currentYear - 35) ? '#800026' :
                    d <= (currentYear - 30)  ? '#BD0026' :
                    d <= (currentYear - 25)  ? '#E31A1C' :
                    d <= (currentYear - 20)  ? '#FC4E2A' :
                    d <= (currentYear - 15)   ? '#FD8D3C' :
                    d <= (currentYear - 10)   ? '#FEB24C' :
                    d <= (currentYear - 5)  ? '#FED976' :
                                '#FFEDA0';
        }

        function style(feature){
                return{
                    weight : 2,
                    opacity : 1,
                    color : 'white',
                    dashArray : '3',
                    fillOpacity : 0.7,
                    fillColor : getColor(parseInt(feature.properties.tahuntanam))
                };
            }

        function highlightFeature(e) {
            var layer = e.target;

            layer.setStyle({
                weight: 5,
                color: '#FF4242',
                dashArray: '',
                fillOpacity: 0
            });

            if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
                layer.bringToFront();
            }

            info.update(layer.feature.properties);
        }

        function resetHighlight(e) {
            geojson.resetStyle(e.target);
            info.update();
        }

        function zoomToFeature(e) {
            map.fitBounds(e.target.getBounds().pad(0.6));
        }

        function onEachFeature(feature, layer) {
            layer.on({
                mouseover: highlightFeature,
                mouseout: resetHighlight,
                click: zoomToFeature
            });
        }

        // LEGEND
        var legend = L.control({
            position: 'bottomleft'
        });
        legend.onAdd = function(map) {

            var div = L.DomUtil.create('div', 'naruto infos legends'),
                grades = [(currentYear - 35), (currentYear - 30), (currentYear - 25), (currentYear - 20), (currentYear - 15), (currentYear - 10), (currentYear - 5)],
                labels = [];
            // loop through our density intervals and generate a label with a colored square for each interval
            div.innerHTML = "<h5>Tahun Tanam</h5>";
            for (var i = 0; i < grades.length; i++) {
                umura = currentYear - grades[i + 1] + 1;
                umur = currentYear - grades[i];

                if (Number.isNaN(umura)) {
                    umurr = "0-" + umur;
                } else if (umur > 30) {
                    umurr = umur + "+";
                } else {
                    umurr = umura + "-" + umur;
                }
                div.innerHTML +=
                    '<i style="background:' + getColor(grades[i] + 1) + '"></i> ' + umurr + " Tahun" + '<br>';
            }

            div.innerHTML +=
                '<i style="background:#ffff"></i> NO DATA<br>';


            return div;
        };
        legend.addTo(map);

        for (let index = 0; index < data.length; index++) {
            var geojson = L.geoJson(data[index], {
                style: style,
                onEachFeature: onEachFeature
            }).addTo(map);
        }
        }
    }

    //INFO
    var info = L.control();
    info.onAdd = function(map) {
        this._div = L.DomUtil.create('div', 'infos');
        this.update();
        return this._div;
    };

    info.update = function(props) {
        let txt = "";
        for (let x in props) {
            if (x == 'Luas' || x == 'luas') {
                txt += x + " : " + props[x].toFixed(2) + "<br>";
            } else {
                txt += x + " : " + props[x] + "<br>";
            }

        };
        this._div.innerHTML = '<h4>INFORMASI KEBUN</h4>' + (props ?
            '<p>Kebun : ' + props.kebun + '</p>' + '<p>Afdeling : ' + props.afdeling + '</p>' + '<p>Jumlah Pohon : ' + props.total_poko + '</p>' + '<p>Blok : ' + props.blok_sap + '</p>' + '<p>Tahun Tanam : ' + props.tahuntanam + '</p>' + '<p>Komoditi : ' + props.komoditi + '</p>' + '<p>Luas : ' + props.luas_ha + ' ha</p>' :
            'Hover di atas wilayah');
    };
    info.addTo(map);

    // this.removeControl(legend);


    function popUp(f, l) {
        var out = [];
        if (f.properties) {
            for (key in f.properties) {
                out.push(key + ": " + f.properties[key]);
            }
            l.bindPopup(out.join("<br/>"));
        }
    }

    map.on('layeradd', function(event) {
        if (event.layer == SENA) {
            map.flyTo([-3.62469, 103.138], 12);
        } else if (event.layer == SULI) {
            map.flyTo([-3.5501578842282644, 103.82327985330386], 12);
        } else if (event.layer == PATU) {
            map.flyTo([-5.021803198545997, 104.95476514185033], 12);
        }
    });

    map.on('click', function(e) {
        var coord = e.latlng;
        var lat = coord.lat;
        var lng = coord.lng;
        // console.log(lat + "," + lng);
    });

    var container = document.getElementsByClassName("leaflet-control-layers")[0];
    if (!L.Browser.touch) {
    L.DomEvent
        .disableClickPropagation(container)
        .disableScrollPropagation(container);
    } else {
    L.DomEvent.disableClickPropagation(container);
    }

    // ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    var loki = '';

    var grades_total_poko = [];
    var grades_pokok_per_ = [];
    var grades_luas_ha = [];

    $(document).ready(function () {
        $('#isi').change(function () {
                if ($(this).val != 0) {
                    var nilai = $(this).val();
                    loki = nilai;
                    $.ajax({
                        type: "POST",
                        url: '/ambilData',
                        data: {
                            'nilai': nilai
                        },
                        success: function (response) {
                            if(nilai == "tahuntanam")
                            {
                                var baris = '';
                                for(var i = 0; i< response.length; i++){
                                    baris += '<tr>'+
                                                '<td class="text-center" style="width: 10%;"><input type="checkbox" value= "'+response[i].tahuntanam+'" id="checkbox_value['+ i +']" onchange="updateBrandName(this)">' +'</td>' + 
                                                '<td>'+ response[i].tahuntanam +'</td>' + 
                                            '<tr>';
                                }
                                $('#target').html(baris);
                            }
                            else if(nilai == "pokok_per_")
                            {
                                var max_num = 0;
                                for (var i = 0; i < response.length; i++) {
                                    if (parseFloat(response[i].pokok_per_) > max_num) {
                                        max_num = parseFloat(response[i].pokok_per_);
                                    }
                                }
                                grades_pokok_per_ = [
                                    parseInt(max_num / 8) * 8,
                                    parseInt(max_num / 8) * 7,
                                    parseInt(max_num / 8) * 6,
                                    parseInt(max_num / 8) * 5,
                                    parseInt(max_num / 8) * 4,
                                    parseInt(max_num / 8) * 3,
                                    parseInt(max_num / 8) * 2,
                                    parseInt(max_num / 8) * 1,
                                    parseInt(max_num / 8) * 0,
                                ];

                                var baris = '';
                                for(var i = 0; i< grades_pokok_per_.length - 1; i++){
                                    baris += '<tr>'+
                                                '<td class="text-center" style="width: 10%;"><input type="checkbox" value= "'+grades_pokok_per_[i]+'" id="checkbox_value['+ i +']" onchange="updateBrandName(this)">' +'</td>' + 
                                                '<td>'+ grades_pokok_per_[i + 1] + ' - ' + grades_pokok_per_[i] +'</td>' + 
                                            '<tr>';
                                }
                                $('#target').html(baris);
                            }
                            else if(nilai == "total_poko")
                            {
                                var max_num = 0;
                                for (var i = 0; i < response.length; i++) {
                                    if (parseFloat(response[i].total_poko) > max_num) {
                                        max_num = parseFloat(response[i].total_poko);
                                    }
                                    // console.log(max_num);
                                }

                                grades_total_poko = [
                                    parseInt(max_num / 8) * 8,
                                    parseInt(max_num / 8) * 7,
                                    parseInt(max_num / 8) * 6,
                                    parseInt(max_num / 8) * 5,
                                    parseInt(max_num / 8) * 4,
                                    parseInt(max_num / 8) * 3,
                                    parseInt(max_num / 8) * 2,
                                    parseInt(max_num / 8) * 1,
                                    parseInt(max_num / 8) * 0,
                                ];

                                var baris = '';
                                for(var i = 0; i< grades_total_poko.length - 1; i++){
                                    baris += '<tr>'+
                                                '<td class="text-center" style="width: 10%;"><input type="checkbox" value= "'+grades_total_poko[i]+'" id="checkbox_value['+ i +']" onchange="updateBrandName(this)">' +'</td>' + 
                                                '<td>'+ grades_total_poko[i + 1] + ' - ' + grades_total_poko[i] +'</td>' + 
                                            '<tr>';
                                }
                                $('#target').html(baris);
                            }
                            else if(nilai == "luas_ha")
                            {
                                var max_num = 0;
                                for (var i = 0; i < response.length; i++) {
                                    if (parseFloat(response[i].luas_ha) > max_num) {
                                        max_num = parseFloat(response[i].luas_ha);
                                    }
                                }
                                
                                
                                grades_luas_ha = [
                                    parseInt(max_num / 8) * 8,
                                    parseInt(max_num / 8) * 7,
                                    parseInt(max_num / 8) * 6,
                                    parseInt(max_num / 8) * 5,
                                    parseInt(max_num / 8) * 4,
                                    parseInt(max_num / 8) * 3,
                                    parseInt(max_num / 8) * 2,
                                    parseInt(max_num / 8) * 1,
                                    parseInt(max_num / 8) * 0
                                ];

                                var baris = '';
                                for(var i = 0; i< grades_luas_ha.length - 1; i++){
                                    baris += '<tr>'+
                                                '<td class="text-center" style="width: 10%;"><input type="checkbox" value= "'+grades_luas_ha[i]+'" id="checkbox_value['+ i +']" onchange="updateBrandName(this)">' +'</td>' + 
                                                '<td>'+ grades_luas_ha[i + 1] + ' - ' + grades_luas_ha[i] +'</td>' + 
                                            '<tr>';
                                }
                                $('#target').html(baris);
                            }
                            
                        }
                    });
                }
            }).change();
    });

    var jokowi = [0];
    var merk_list = [];
    function updateBrandName(obj) {
        let checkbox_id = document.getElementById(obj.id);
        let brand_name = checkbox_id.value;
        let index = merk_list.indexOf(brand_name);

        if(checkbox_id.checked){
            if(index < 0){
                merk_list.push(brand_name);
            }
        }
        else{
            if(index > -1){
                merk_list.splice(index, 1);
            }
        }
        // ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        if(loki === "total_poko")
        {

            function getColor(d, e, grades) {
                for (var i = 0; i < e.length; i++) {
                        for (var j = 0; j < grades.length; j++) {
                            if (parseInt(e[i]) === grades[j]){
                                if((d >= grades[j+1]) && (d <= grades[j])) {
                                    console.log("nilai nya : " + d + " |||||| nilai > " + grades[j+1] + " dan " + "nilai < " + grades[j]);
                                    return '#0300ff';
                                }else{
                                    return '#fff';
                                }
                            }
                        }
                    }
            }

            function style(feature) {
                return {
                    weight: 2,
                    opacity: 1,
                    color: 'white',
                    dashArray: '3',
                    fillOpacity: 1,
                    fillColor: getColor(parseInt(feature.properties.total_poko),merk_list, grades_total_poko)
                };
            }
            
        }
        else if(loki === "tahuntanam")
        {
            console.log(loki);
            function getColor(d, e) {
                for (var index = 0; index < e.length; index++) {
                    if (parseInt(e[index]) === d){
                        return '#0300ff';
                    }else{
                        return '#ffff';
                    }
                }
            }

            function style(feature) {
                return {
                    weight: 2,
                    opacity: 1,
                    color: 'white',
                    dashArray: '3',
                    fillOpacity: 1,
                    fillColor: getColor(parseInt(feature.properties.tahuntanam),merk_list)
                };
            }
        }
        else if(loki === "pokok_per_")
        {
            function getColor(d, e, grades) {
                for (var i = 0; i < e.length; i++) {
                        for (var j = 0; j < grades.length; j++) {
                            if (parseInt(e[i]) === grades[j]){
                                if((d >= grades[j+1]) && (d <= grades[j])) {
                                    console.log("nilai nya : " + d + " |||||| nilai > " + grades[j+1] + " dan " + "nilai < " + grades[j]);
                                    return '#0300ff';
                                }else{
                                    return '#fff';
                                }
                            }
                        }
                    }
            }

            function style(feature) {
                return {
                    weight: 2,
                    opacity: 1,
                    color: 'white',
                    dashArray: '3',
                    fillOpacity: 1,
                    fillColor: getColor(parseInt(feature.properties.pokok_per_),merk_list, grades_pokok_per_)
                };
            }
        }
        else
        {
            function getColor(d, e, grades) {
                for (var i = 0; i < e.length; i++) {
                        for (var j = 0; j < grades.length; j++) {
                            if (parseInt(e[i]) === grades[j]){
                                if((d >= grades[j+1]) && (d <= grades[j])) {
                                    console.log("nilai nya : " + d + " |||||| nilai > " + grades[j+1] + " dan " + "nilai < " + grades[j]);
                                    return '#0300ff';
                                }else{
                                    return '#fff';
                                }
                            }
                        }
                    }
            }

            function style(feature) {
                return {
                    weight: 2,
                    opacity: 1,
                    color: 'white',
                    dashArray: '3',
                    fillOpacity: 1,
                    fillColor: getColor(parseInt(feature.properties.luas_ha),merk_list, grades_luas_ha)
                };
            }
        }

            function highlightFeature(e) {
                var layer = e.target;

                layer.setStyle({weight: 5, color: '#FF4242', dashArray: '', fillOpacity: 0});

                if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
                    layer.bringToFront();
                }

                info.update(layer.feature.properties);
            }

            function resetHighlight(e) {
                geojson.resetStyle(e.target);
                info.update();
            }

            function zoomToFeature(e) {
                map.fitBounds(e.target.getBounds().pad(0.6));
            }

            function onEachFeature(feature, layer) {
                layer.on(
                    {mouseover: highlightFeature, mouseout: resetHighlight, click: zoomToFeature}
                );
            }

            for (let index = 0; index < data.length; index++) {
                var geojson = L
                    .geoJson(data[index], {
                        style: style,
                        onEachFeature: onEachFeature
                    })
                    .addTo(map);
            }
        // ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    }
    
    window.onload = onLoadPage();
</script>