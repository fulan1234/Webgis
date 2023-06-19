<body style="background-color: #f4f6f9;">
    <h2 style="margin-top: 50px;">PTPN 7 Map</h2>

    <select id="pilihan" class="mb-3" onchange="getSelectValue(this.value)">
        <option value="default">Default</option>
        <option value="total_poko">Jumlah Pohon</option>
        <option value="pokok_per_">Per pohon</option>
        <option value="tahuntanam">Tahun Tanam</option>
        <option value="luas_ha">Luas</option>
    </select>

    <!-- <button onclick="koko()"><H6>hapus</H6></button> -->
    <div class="card">
        <div class="card-body" style="box-shadow: 5px;">
            <div id="maps"></div>

            <select id="isi" class="mb-3 mt-5">
              <option value="default">Default</option>
              <option value="total_poko">Jumlah Pohon</option>
              <option value="pokok_per_">Per pohon</option>
              <option value="tahuntanam">Tahun Tanam</option>
              <option value="luas_ha">Luas</option>
            </select>

            <div class="mt-3">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>CheckBox</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    <tbody id="target"></tbody>
                </table>
            </div>
            <script>
                function onLoadPage() {
            // cara 1 / option 1:
            // updateBrandName(document.getElementById("apple_check"));

            // cara 2 / option 2:
            document.getElementById("checkbox_value[0]").addEventListener("change", updateBrandName(document.getElementById("checkbox_value[0]")));
            }     
            </script>
        </div>
    </div>
</body>