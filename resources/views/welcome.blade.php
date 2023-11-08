<!DOCTYPE html>
<?php

?>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
        {{-- Thu vien ve duong di --}}
        <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
        <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </head>
    <body class="antialiased">
        <style>
            #map { height: 100vh; }
            .search-container {
            padding: 10px;
        }
        </style>
    <div class="container-fluid">
        <div class="row top-menu w-100 d-flex justify-content-between">
                <div class="d-flex align-items-center ms-3">
                    <span id='toado'>Toạ độ:</span>
                </div>
                <div class="search-container d-flex">
                    <input type="text" class="form-control" id="searchInput" placeholder="Nhập từ khoá tìm kiếm...">
                    <button id="searchButton" class="btn btn-primary ms-2">Tìm kiếm</button>
                </div>
        </div>
        <div class="row">
            <div class="col-3">
                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Danh sách nhà trọ
                </button>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        <ul class="list-group">
                            <?php 
                            foreach($thong_tin_khu_tro as $key => $value){ ?>
                                <li onclick="goto(this)" data-info="{{$value['hoten']}}" data-id="{{$value['id']}}" data-latlng="{{$value['toadoGPS']}}" class=" btn btn-light text-start  list-group-item">{{$value['hoten']}}
                                    <svg onclick="removeTro(this)" style="position: absolute; right: 10;" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                                </li>
                                <div class="d-flex">
                                    <button class="btn btn-link text-start" type="button" data-bs-toggle="collapse" data-bs-target="#Collapse_{{$value['id']}}" aria-expanded="false" aria-controls="multiCollapseExample2">Chi tiết</button>    
                                    <button onclick="OpenModalUpdateTro({{$value}})" class="btn btn-link text-start" type="button">Edit</button>    
                                </div>
                                
                                <div class="collapse multi-collapse" id="Collapse_{{$value['id']}}">
                                    <div class="card card-body">
                                        <b>Đường:</b> <span>{{$value['diachi']['tenduong']}}</span>
                                        <b>Xã:</b> <span>{{$value['diachi']['tenxa']}}</span>
                                        <b>Huyện:</b> <span>{{$value['diachi']['tenhuyen']}}</span>
                                        <b>Tỉnh:</b> <span>{{$value['diachi']['tentinh']}}</span>
                                        <b>Số nhà:</b> <span>{{$value['diachi']['sonha']}}</span>
                                        @if($value['tinhtrang']['id'] == 3)
                                            <b>Tình trạng:</b> <span class="badge bg-success">{{$value['tinhtrang']['ten']}}</span>
                                        @else
                                            <b>Tình trạng:</b> <span class="badge bg-danger">{{$value['tinhtrang']['ten']}}</span>
                                        @endif

                                        <h5>Thông tin chủ trọ</h5>
                                        <b>Họ tên:</b> <span>{{$value['chutro']['hoten']}}</span>
                                        <b>Giới tính:</b> <span>{{$value['chutro']['gioitinh']}}</span>
                                        <b>SĐT:</b> <span>{{$value['chutro']['SDT']}}</span>
                                        <b>latLng:</b> <span>{{$value['toadoGPS']}}</span>

                                    </div>
                                </div>
                            <?php }?>
                        
                        </ul>
                        
                    </div>
                </div>
                <br>
                <button class="btn btn-primary mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
                    Danh sách trường học
                </button>
                <div class="collapse" id="collapseExample2">
                    
                    <div class="card card-body">
                        <ul class="list-group">
                            <?php 
                            foreach($thong_tin_truong_dai_hoc as $key => $value){ ?>
                         
                                <li onclick="goto(this)" data-info="{{$value['tentruong']}}" data-id="{{$value['id']}}" data-latlng="{{$value['toadoGPS']}}" class="btn btn-light text-start  list-group-item">{{$value['tentruong']}}
                                    <svg onclick="removeTruong(this)" style="position: absolute; right: 10;" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                                </li>
                                <div class="d-flex">
                                    <button class="btn btn-link text-start" type="button" data-bs-toggle="collapse" data-bs-target="#Collapse2_{{$value['id']}}" aria-expanded="false" aria-controls="multiCollapseExample2">Chi tiết</button>    
                                    <button onclick="OpenModalUpdateTruong({{$value}})" class="btn btn-link text-start" type="button">Edit</button>    
                                </div>
                                <div class="collapse multi-collapse" id="Collapse2_{{$value['id']}}">
                                    <div class="card card-body">
                                        <b>Đường:</b> <span>{{$value['diachi']['tenduong']}}</span>
                                        <b>Xã:</b> <span>{{$value['diachi']['tenxa']}}</span>
                                        <b>Huyện:</b> <span>{{$value['diachi']['tenhuyen']}}</span>
                                        <b>Tỉnh:</b> <span>{{$value['diachi']['tentinh']}}</span>
                                    </div>
                                </div>
                            <?php }?>
                        
                        </ul>
                        
                    </div>
                </div>
                <hr>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#doKhoangCach">Đo khoảng cách</button>
                <div class="modal" id="doKhoangCach" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Đo khoảng cách</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <h3 class="text-center">Chọn trường học</h3>
                                    <ul id="truongList_khoangCach" class="list-group ">
                                        <?php 
                                        foreach($thong_tin_truong_dai_hoc as $key => $value){ ?>
                                            <li onclick="chooseItemDistance(this)" data-latlng="{{$value['toadoGPS']}}" class="btn btn-light text-start  list-group-item">{{$value['tentruong']}}</li>
                                        <?php }?>
                                    
                                    </ul>
                                </div>
                                <div class="col-auto">|</div>
                                <div class="col">
                                    <h3 class="text-center">Chọn nhà trọ</h3>
                                    <ul id="troList_khoangCach" class="list-group">
                                        <?php 
                                        foreach($thong_tin_khu_tro as $key => $value){ ?>
                                            <li onclick="chooseItemDistance(this)" data-latlng="{{$value['toadoGPS']}}" class=" btn btn-light text-start  list-group-item">{{$value['hoten']}}</li>
                                        <?php }?>
                                    
                                    </ul>
                                </div>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button id="closeModalInsertLocation" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button onclick="DoKhoangCach()" type="button" class="btn btn-primary">Save changes</button>
                        </div>
                        </div>
                    </div>
                </div>  
            </div>
            <div class="col-9">
                <div id="map"></div>
            </div>
            
        </div>
        <!-- Modal Create new position-->
        <div class="modal" id="newPositionModal" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create new Location</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Nhà trọ</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Trường học</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <label for="basic-url" class="form-label">Tên nhà trọ: </label>
                                <div class="input-group mb-3">
                                    <input id="nameTro" value="" class="form-control" />
                                </div>
                                <label for="basic-url" class="form-label">Loại phòng: </label>
                                <div class="input-group mb-3">
                                    <select id="loaiphongSelect" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                        <option selected>Open this select menu</option>
                                        <?php foreach($thong_tin_loai_phong as $key => $value){ ?>
                                        <option value="<?=$value['id']?>">{{$value['tenloai']}}</option>
                                        <?php }?>
                                    </select>
                                </div>

                                <label for="basic-url" class="form-label">Số nhà: </label>
                                <input id="soNha" value="" class="form-control" />

                                

                                <label for="basic-url" class="form-label">Họ tên chủ trọ: </label>
                                <input id="hoTen" value="" class="form-control" />

                                <label for="basic-url" class="form-label">Giới tính chủ trọ: </label>
                                <div class="input-group mb-3">
                                    <select id="sex" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                        <option selected value="Nam">Nam</option>
                                        <option value="Nữ">Nữ</option>
                                    </select>
                                </div>   

                                <label for="basic-url" class="form-label">SĐT chủ trọ: </label>
                                <input id="SDT" value="" class="form-control" />
                                
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <label for="basic-url" class="form-label">Tên trường học: </label>
                                <div class="input-group mb-3">
                                    <input id="nameTruong" value="" class="form-control" />
                                </div>
                        </div>
                        <!-- DIA CHI -->
                        

                        <label for="basic-url" class="form-label">Tên đường: </label>
                        <input id="tenDuong" value="" class="form-control" />

                        <label for="basic-url" class="form-label">Tên xã: </label>
                        <input id="tenXa" value="" class="form-control" />

                        <label for="basic-url" class="form-label">Tên huyện: </label>
                        <input id="tenHuyen" value="" class="form-control" />

                        <label for="basic-url" class="form-label">Tên tỉnh: </label>
                        <input id="tenTinh" value="" class="form-control" />
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button onclick="CloseModalInsertLocation()"  type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="saveButton" type="button" class="btn btn-primary">Thêm</button>
                </div>
                </div>
            </div>
        </div>   
        <!-- Modal update nhà trọ-->
        <div class="modal" id="updateTroModal" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Location</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input id="id_tro_update" hidden type="text"/>
                        <input id="id_diachitro_update" hidden type="text"/>
                        <input id="latLngTro_update" hidden type="text"/>
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Nhà trọ</button>
                            </li>
                            
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <label for="basic-url" class="form-label">Tên nhà trọ: </label>
                                    <div class="input-group mb-3">
                                        <input id="nameTro_updateTro" value="" class="form-control" />
                                    </div>
                                    <label for="basic-url" class="form-label">Loại phòng: </label>
                                    <div class="input-group mb-3">
                                        <select id="loaiphongSelect_updateTro" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                            <option selected>Open this select menu</option>
                                            <?php foreach($thong_tin_loai_phong as $key => $value){ ?>
                                            <option value="<?=$value['id']?>">{{$value['tenloai']}}</option>
                                            <?php }?>
                                        </select>
                                    </div>

                                    <label for="basic-url" class="form-label">Số nhà: </label>
                                    <input id="soNha_updateTro" value="" class="form-control" />

                                    <label for="basic-url" class="form-label">Tình trạng: </label>
                                    <div class="input-group mb-3">
                                        <select id="tinhTrang_updateTro" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                            <option selected>Open this select menu</option>
                                            <?php foreach($tinhtrang as $key => $value){ ?>
                                            <option value="<?=$value['id']?>">{{$value['ten']}}</option>
                                            <?php }?>
                                        </select>
                                    </div>
                            </div>
                            <!-- DIA CHI -->
                            

                            <label for="basic-url" class="form-label">Tên đường: </label>
                            <input id="tenDuong_updateTro" value="" class="form-control" />

                            <label for="basic-url" class="form-label">Tên xã: </label>
                            <input id="tenXa_updateTro" value="" class="form-control" />

                            <label for="basic-url" class="form-label">Tên huyện: </label>
                            <input id="tenHuyen_updateTro" value="" class="form-control" />

                            <label for="basic-url" class="form-label">Tên tỉnh: </label>
                            <input id="tenTinh_updateTro" value="" class="form-control" />

                            <h5>Thông tin chủ trọ</h5>
                            <input id="id_chutro_update" hidden class="form-control" />
                            

                            <label for="basic-url" class="form-label">Họ tên chủ trọ: </label>
                            <input id="hoTen_update" value="" class="form-control" />

                            <label for="basic-url" class="form-label">Giới tính chủ trọ: </label>
                            <div class="input-group mb-3">
                                <select id="sex_update" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                    <option selected value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                </select>
                            </div>   

                            <label for="basic-url" class="form-label">SĐT chủ trọ: </label>
                            <input id="SDT_update" value="" class="form-control" />

                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button id="saveButton_updateTro" type="button" class="btn btn-primary">Cập nhật</button>
                    </div>
                </div>
            </div>
        </div>   
        <!-- Modal update trường-->
        <div class="modal" id="updateTruongModal" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Location</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input id="id_truong_update" hidden type="text"/>
                        <input id="id_diachitruong_update" hidden type="text"/>
                        <input id="latLngTruong_update" hidden type="text"/>
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Trường</button>
                            </li>
                            
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <label for="basic-url" class="form-label">Tên trường: </label>
                                    <div class="input-group mb-3">
                                        <input id="nameTruong_update" value="" class="form-control" />
                                    </div>
                            </div>
                            <!-- DIA CHI -->
                            

                            <label for="basic-url" class="form-label">Tên đường: </label>
                            <input id="tenDuong_updateTruong" value="" class="form-control" />

                            <label for="basic-url" class="form-label">Tên xã: </label>
                            <input id="tenXa_updateTruong" value="" class="form-control" />

                            <label for="basic-url" class="form-label">Tên huyện: </label>
                            <input id="tenHuyen_updateTruong" value="" class="form-control" />

                            <label for="basic-url" class="form-label">Tên tỉnh: </label>
                            <input id="tenTinh_updateTruong" value="" class="form-control" />
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button id="saveButton_updateTruong" type="button" class="btn btn-primary">Cập nhật</button>
                    </div>
                </div>
            </div>
        </div>   
    </div>
    
        </body>
</html>
<script>
let thong_tin_truong_dai_hoc = <?=$thong_tin_truong_dai_hoc?>;
let thong_tin_khu_tro = <?=$thong_tin_khu_tro?>;
let thong_tin_loai_phong = <?=$thong_tin_loai_phong?>;
console.log('thong_tin_khu_tro',thong_tin_khu_tro);
console.log('thong_tin_truong_dai_hoc',thong_tin_truong_dai_hoc);
var map = L.map('map').setView([10.029938, 105.768433], 16);
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

var redIcon = L.icon({
    iconUrl: '/red.png',  // Đường dẫn đến biểu tượng màu đỏ
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',  // Bóng của biểu tượng
    iconSize: [25, 41],  // Kích thước của biểu tượng. Cần điều chỉnh nếu khác với kích thước mặc định
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
});
map.eachLayer(function (layer) {
    if (layer instanceof L.Marker) {
        map.removeLayer(layer);
    }
});
var troList = [];
var truongList = [];
thong_tin_truong_dai_hoc.forEach(school => {
    let toadoGPS = school.toadoGPS;
    let toadoGPSarr = toadoGPS.split(',');
    let lat = toadoGPSarr[0].trim();
    let lng = toadoGPSarr[1].trim();
    // let lat = school.toadoGPS.
    truongList.push({
        latlng: [lat, lng],
        info: `<b>${school.tentruong}</b><br> Trường học`
    })
});
thong_tin_khu_tro.forEach(nhatro => {
    let toadoGPS = nhatro.toadoGPS;
    let toadoGPSarr = toadoGPS.split(',');
    let lat = toadoGPSarr[0].trim();
    let lng = toadoGPSarr[1].trim();
    // let lat = school.toadoGPS.
    troList.push({
        latlng: [lat, lng],
        info: `<b>${nhatro.hoten}</b><br>Nhà trọ`,
        xa: `${nhatro.diachi.tenxa}`
    })
});
// Lưu lại thông tin của từng xã và tạo một danh sách các xã có cùng thông tin (trong trường hợp có xã giống nhau). Dựa trên mãng troList mà bạn đã tạo:
var xaNhaTroColors = {}; // Đối tượng lưu màu sắc cho từng xã

troList.forEach(function (tro) {
    console.log('tro',tro);
    var xa = tro.xa; // Lấy thông tin xã từ dữ liệu
    if (!xaNhaTroColors[xa]) {
        // Nếu xã chưa tồn tại trong danh sách màu sắc, tạo màu mới
        var randomColor = '#' + Math.floor(Math.random()*16777215).toString(16); // Tạo màu ngẫu nhiên
        xaNhaTroColors[xa] = randomColor;
    }
});
// Tiếp theo, bạn cần tạo các vùng polygon cho từng xã. Dựa vào danh sách màu sắc và thông tin xã, bạn có thể lặp qua danh sách troList và tạo polygon cho từng xã. Dưới đây là một ví dụ cách làm:
var troClusters = {}; // Đối tượng lưu các vùng `tro` có xã chung

troList.forEach(function (tro) {
    var xa = tro.xa;
    if (!troClusters[xa]) {
        // Nếu xã chưa có cluster, tạo cluster mới và thêm `tro` vào đó
        troClusters[xa] = [tro];
    } else {
        // Nếu xã đã có cluster, thêm `tro` vào cluster đó
        troClusters[xa].push(tro);
    }
});
console.log('troClusters',troClusters);
var polygons = []; // Danh sách chứa tất cả các polygon

// Duyệt qua các cluster và vẽ cho từng cluster
for (var xa in troClusters) {
    var cluster = troClusters[xa];
    var latLngs = cluster.map(function (tro) {
        return tro.latlng;
    });
    var randomColor = '#' + Math.floor(Math.random() * 16777215).toString(16); // Màu ngẫu nhiên cho từng cluster
    var polygon = L.polygon(latLngs, {
        fillColor: randomColor,
        fillOpacity: 0.5,
        color: 'black',
        weight: 2
    }).addTo(map);

    // Tính toán tọa độ tâm của polygon
    var center = polygon.getBounds().getCenter();

    // Tạo icon để hiển thị tên xã
    var icon = L.divIcon({
        className: 'custom-div-icon',
        html: '<div style="font-size: 40px;">' + xa + '</div>',
        iconSize: [100, 40]
    });

    // Tạo một layer mới cho biểu tượng hiển thị tên xã
    var xaNameLayer = L.layerGroup().addTo(map);

    // Tạo marker ở tâm của polygon và đặt biểu tượng icon để hiển thị tên xã
    var marker = L.marker(center, { icon: icon }).addTo(xaNameLayer);

    // Thêm polygon vào danh sách
    polygons.push({ polygon: polygon, xaNameLayer: xaNameLayer });
}

// Sử dụng sự kiện 'zoomend' để kiểm tra mức độ zoom và hiển thị/ẩn tên xã cho tất cả các polygon
map.on('zoomend', function () {
    // Lấy mức độ zoom hiện tại của bản đồ
    var currentZoom = map.getZoom();

    // Duyệt qua danh sách các polygon
    polygons.forEach(function (item) {
        var polygon = item.polygon;
        var xaNameLayer = item.xaNameLayer;

        // Kiểm tra nếu mức độ zoom đạt mức đủ gần (ví dụ: 15)
        if (currentZoom >= 16) {
            // Hiển thị tên xã ở tâm của polygon
            xaNameLayer.addTo(map);
        } else {
            // Nếu không đạt mức độ zoom đủ gần, ẩn tên xã nếu có
            map.removeLayer(xaNameLayer);
        }
    });
});




    troList.forEach(function(tro) {
        var marker = L.marker(tro.latlng,{icon:redIcon}).addTo(map);
        marker.bindPopup(tro.info);
    });
    truongList.forEach(function(tro) {
        var marker = L.marker(tro.latlng).addTo(map);
        marker.bindPopup(tro.info);
    });

// var polygon = L.polygon([
//     [10.008818, 105.749931],
//     [10.034781083629046,105.77143350888034],
//     [10.032668135128208,105.76281951221452],
// ]).addTo(map);

// Hiển thị toạ độ khi mouse move
map.on('mousemove', function(e) {
    $('#toado').html(`Toạ độ: (${e.latlng.lat}, ${e.latlng.lng})`);

});

// Bắt sự kiện double click trên bản đồ
var savedLocations = []; // Mảng lưu trữ các địa điểm đã lưu
map.on('dblclick', function(event) {
    var modal = $('#newPositionModal');
    modal.modal('show');
    
    var latlng = event.latlng; // Lấy tọa độ khi double click
    let name = 'New Location';
    // Tạo một L.Marker tại tọa độ double click
    var marker = L.marker(latlng).addTo(map);
    marker.bindPopup(name);
    marker.openPopup();

    // Lưu tọa độ và tên địa điểm vào mảng savedLocations
    savedLocations.push({
        latlng: latlng,
        name: name,
        marker: marker,
    });
    console.log(savedLocations);

});
function CloseModalInsertLocation()
{
    var modal = $('#newPositionModal');
    modal.modal('hide');

    // Nếu modal đóng sẽ xóa điểm "New Location"
    var location = savedLocations.find(location => location.name === 'New Location');
    console.log(location);
    console.log(location.marker);
    if (location && location.marker) {
        map.removeLayer(location.marker); // Loại bỏ marker khỏi bản đồ
        savedLocations = savedLocations.filter(location => location.name !== 'New Location'); // Xóa khỏi mảng savedLocations
        console.log(savedLocations);
    }
}

// Cái này dùng để xóa đi icon - thực ra tôi đã sử dụng nhiều cách khác nhau để xóa nhưng vẫn không được
// chỉ là vô tình cách này muốn đổi màu sắc icon nhưng vô tình nó không hoạt động mà nó lại bị ẩn đi icon =))
// nên là lợi dụng nó để làm ẩn đi icon sinh ra khi đo khoảng cách
var yellowIcon = L.divIcon({
    className: 'custom-icon',
    html: '<div style="background-color: yellow;" class="marker-pin"></div>',
    iconSize: [30, 42],
    iconAnchor: [15, 42],
    popupAnchor: [0, -34]
});
function OpenModalUpdateTro(value)
{
    console.log(value);
    $('#id_tro_update').val(value.id);
    $('#id_chutro_update').val(value.chutro.id);
    $('#hoTen_update').val(value.chutro.hoten);
    $('#sex_update').val(value.chutro.gioitinh);
    $('#SDT_update').val(value.chutro.SDT);


    $('#id_diachitro_update').val(value.id_diachi);
    $('#latLngTro_update').val(value.toadoGPS);
    $('#tinhTrang_updateTro').val(value.tinhtrang.id);
    $('#updateTroModal').modal('show');
    $('#nameTro_updateTro').val(value.hoten);
    $('#loaiphongSelect_updateTro').val(value.loaiphong);
    $('#soNha_updateTro').val(value.diachi.sonha);
    $('#tenDuong_updateTro').val(value.diachi.tenduong);
    $('#tenXa_updateTro').val(value.diachi.tenxa);
    $('#tenHuyen_updateTro').val(value.diachi.tenhuyen);
    $('#tenTinh_updateTro').val(value.diachi.tentinh);
}
function OpenModalUpdateTruong(value)
{
    console.log(value);
    $('#id_truong_update').val(value.id);
    $('#id_diachitruong_update').val(value.id_diachi);
    $('#latLngTruong_update').val(value.toadoGPS);
    $('#updateTruongModal').modal('show');
    $('#nameTruong_update').val(value.tentruong);
    $('#soNha_updateTruong').val(value.diachi.sonha);
    $('#tenDuong_updateTruong').val(value.diachi.tenduong);
    $('#tenXa_updateTruong').val(value.diachi.tenxa);
    $('#tenHuyen_updateTruong').val(value.diachi.tenhuyen);
    $('#tenTinh_updateTruong').val(value.diachi.tentinh);
}
function removeTruong(icon)
{
    $li = $(icon).closest('li');
    let id = $li.attr('data-id');
    Swal.fire({
        title: "Bạn có thực sự muốn xóa",
        showCancelButton: true,
        confirmButtonText: "Yes",
        }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: '/api/truong/delete-location', // Đường dẫn xử lý lưu dữ liệu
                dataType: 'json',
                data: {
                    // nameTruong: nameTruong,
                    id: id,
                },
                success: function(response) {
                    // Xử lý thành công
                    if (response.status === 'success') {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Deleted",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        document.location.reload();
                    } else {
                        // Xử lý lỗi
                        alert('Có lỗi xảy ra khi lưu dữ liệu.');
                    }
                },

                error: function() {
                    // Xử lý lỗi kết nối
                    alert('Không thể kết nối đến máy chủ.');
                }
            });
           
        }
    });
}
function removeTro(icon)
{
    $li = $(icon).closest('li');
    let id = $li.attr('data-id');
    Swal.fire({
        title: "Bạn có thực sự muốn xóa",
        showCancelButton: true,
        confirmButtonText: "Yes",
        }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: '/api/tro/delete-location', // Đường dẫn xử lý lưu dữ liệu
                dataType: 'json',
                data: {
                    // nameTruong: nameTruong,
                    id: id,
                },
                success: function(response) {
                    // Xử lý thành công
                    if (response.status === 'success') {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Deleted",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        document.location.reload();
                    } else {
                        // Xử lý lỗi
                        alert('Có lỗi xảy ra khi lưu dữ liệu.');
                    }
                },

                error: function() {
                    // Xử lý lỗi kết nối
                    alert('Không thể kết nối đến máy chủ.');
                }
            });
           
        }
    });
}
function DoKhoangCach() {
    var $itemTruong = $('#truongList_khoangCach').find('.active');
    var $itemTro = $('#troList_khoangCach').find('.active');
    var truongLatLngStr = $itemTruong.attr('data-latlng');
    var troLatLngStr = $itemTro.attr('data-latlng'); // Sửa tên biến thành troLatLngStr

    if (truongLatLngStr && troLatLngStr) {
        var truongLatLngArr = truongLatLngStr.split(',').map(parseFloat);
        var troLatLngArr = troLatLngStr.split(',').map(parseFloat);

        var truongLatLng = L.latLng(truongLatLngArr[0], truongLatLngArr[1]);
        var troLatLng = L.latLng(troLatLngArr[0], troLatLngArr[1]);

        var distance = troLatLng.distanceTo(truongLatLng);
        console.log("Khoảng cách từ Nhà trọ tới Trường Đại học Cần Thơ: " + (distance / 1000).toFixed(2) + " km");
        L.Routing.control({
            waypoints: [troLatLng, truongLatLng],
            routeWhileDragging: true,
            createMarker: function(i, wp, nWps) {
                if (i === nWps - 1) {
                    return L.marker(wp.latLng, {
                        icon: yellowIcon // Sử dụng biểu tượng màu vàng cho điểm đến cuối cùng
                    });
                }
            }
        }).addTo(map);

        $('#doKhoangCach').modal('hide');
    }
}

function chooseItemDistance(li)
{
    $ul = $(li).closest('ul');
    $ul.find('li').removeClass('active');
    $(li).addClass('active');
}
function goto(el)
{
    var latlngStr = el.getAttribute('data-latlng');
    var info = el.getAttribute('data-info');
    var latlng;
    if (latlngStr) {
        var latlngArr = latlngStr.split(',').map(parseFloat);
        latlng = [latlngArr[0], latlngArr[1]];

        map.setView(latlng, 18);
    }
    
    // Tự động hiển thị popup
    var marker = L.marker(latlng, { icon: yellowIcon }).addTo(map); // Tạo marker với biểu tượng null
    marker.bindPopup(info);
    marker.openPopup(); 

}
$('#saveButton_updateTruong').on('click', function() {
    // Lấy giá trị từ form
    var id = $('#id_truong_update').val();
    var id_diachi = $('#id_diachitruong_update').val();
    var latLng = $('#latLngTruong_update').val();

    var nameTruong = $('#nameTruong_update').val();
    var tenDuong = $('#tenDuong_updateTruong').val();
    var tenXa = $('#tenXa_updateTruong').val();
    var tenHuyen = $('#tenHuyen_updateTruong').val();
    var tenTinh = $('#tenTinh_updateTruong').val();
    

    // Xác định tab hiện tại (Nhà trọ hoặc Trường học)
    var activeTab = $('#pills-tab .nav-link.active').attr('id');
    var locationType = (activeTab === 'pills-home-tab') ? 'nhatro' : 'truonghoc';
    // Gửi dữ liệu lên server để lưu vào cơ sở dữ liệu
    $.ajax({
        type: 'POST',
        url: '/api/update-location-truong', // Đường dẫn xử lý lưu dữ liệu
        dataType: 'json',
        data: {
            id: id,
            id_diachi: id_diachi,
            nameTruong: nameTruong,
            toadoGPS: latLng,
            type: locationType,
            tenDuong: tenDuong,
            tenXa: tenXa,
            tenHuyen: tenHuyen,
            tenTinh: tenTinh
        },
        success: function(response) {
            // Xử lý thành công
            if (response.status === 'success') {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Updated",
                    showConfirmButton: false,
                    timer: 1500
                });
                document.location.reload();
            } else {
                // Xử lý lỗi
                alert('Có lỗi xảy ra khi lưu dữ liệu.');
            }
        },
        error: function() {
            // Xử lý lỗi kết nối
            alert('Không thể kết nối đến máy chủ.');
        }
    });
});
$('#saveButton_updateTro').on('click', function() {
    // Lấy giá trị từ form
    var id = $('#id_tro_update').val();
    var id_diachi = $('#id_diachitro_update').val();
    var latLng = $('#latLngTro_update').val();
    var id_tinhtrang = $('#tinhTrang_updateTro').val();
    var hoTen = $('#hoTen_update').val();
    var sex = $('#sex_update').val();
    var SDT = $('#SDT_update').val();
    var id_chutro_update = $('#id_chutro_update').val();

    var nameTruong = $('#nameTruong_updateTro').val();
    var nameTro = $('#nameTro_updateTro').val();
    var soNha = $('#soNha_updateTro').val();
    var tenDuong = $('#tenDuong_updateTro').val();
    var tenXa = $('#tenXa_updateTro').val();
    var tenHuyen = $('#tenHuyen_updateTro').val();
    var tenTinh = $('#tenTinh_updateTro').val();
    var loaiPhong = $('#loaiphongSelect_updateTro').val();
    

    // Xác định tab hiện tại (Nhà trọ hoặc Trường học)
    var activeTab = $('#pills-tab .nav-link.active').attr('id');
    var locationType = (activeTab === 'pills-home-tab') ? 'nhatro' : 'truonghoc';
    // Gửi dữ liệu lên server để lưu vào cơ sở dữ liệu
    $.ajax({
        type: 'POST',
        url: '/api/update-location-tro', // Đường dẫn xử lý lưu dữ liệu
        dataType: 'json',
        data: {
            id: id,
            id_diachi: id_diachi,
            id_chutro: id_chutro_update,
            hoTen: hoTen,
            sex: sex,
            SDT: SDT,
            nameTruong: nameTruong,
            nameTro: nameTro,
            toadoGPS: latLng,
            type: locationType,
            loaiphong: loaiPhong,
            soNha: soNha,
            tenDuong: tenDuong,
            tenXa: tenXa,
            tenHuyen: tenHuyen,
            tenTinh: tenTinh,
            id_tinhtrang: id_tinhtrang
        },
        success: function(response) {
            // Xử lý thành công
            if (response.status === 'success') {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Updated",
                    showConfirmButton: false,
                    timer: 1500
                });
                document.location.reload();
            } else {
                // Xử lý lỗi
                alert('Có lỗi xảy ra khi lưu dữ liệu.');
            }
        },
        error: function() {
            // Xử lý lỗi kết nối
            alert('Không thể kết nối đến máy chủ.');
        }
    });
});
$('#saveButton').on('click', function() {
    // Lấy giá trị từ form
    var nameTruong = $('#nameTruong').val();
    var nameTro = $('#nameTro').val();
    var soNha = $('#soNha').val();
    var hoTen = $('#hoTen').val();
    var sex = $('#sex').val();
    var SDT = $('#SDT').val();
    var tenDuong = $('#tenDuong').val();
    var tenXa = $('#tenXa').val();
    var tenHuyen = $('#tenHuyen').val();
    var tenTinh = $('#tenTinh').val();
    




    var lastLocation = savedLocations[savedLocations.length - 1]; // Lấy phần tử cuối cùng
    if (lastLocation) {
        var lat = lastLocation.latlng.lat;
        var lng = lastLocation.latlng.lng;
        
        // Tiếp theo, bạn có thể sử dụng lat và lng trong quá trình lưu dữ liệu.
    }

    // Xác định tab hiện tại (Nhà trọ hoặc Trường học)
    var activeTab = $('#pills-tab .nav-link.active').attr('id');
    var locationType = (activeTab === 'pills-home-tab') ? 'nhatro' : 'truonghoc';
    // Gửi dữ liệu lên server để lưu vào cơ sở dữ liệu
    $.ajax({
        type: 'POST',
        url: '/api/add-location', // Đường dẫn xử lý lưu dữ liệu
        dataType: 'json',
        data: {
            nameTruong: nameTruong,
            nameTro: nameTro,
            lat: lat,
            lng: lng,
            type: locationType,
            loaiphong: $('#loaiphongSelect').val(),
            soNha: soNha,
            hoTen: hoTen,
            sex: sex,
            SDT: SDT,
            tenDuong: tenDuong,
            tenXa: tenXa,
            tenHuyen: tenHuyen,
            tenTinh: tenTinh
        },
        success: function(response) {
            // Xử lý thành công
            if (response.status === 'success') {
                // Thêm marker mới vào bản đồ
                var marker = L.marker([lat, lng]).addTo(map);
                if(locationType == 'truonghoc')
                {
                    marker.bindPopup(nameTruong);
                    lastLocation.name = nameTruong;
                }
                else
                {
                    marker.bindPopup(nameTro);
                    lastLocation.name = nameTro;

                    // Đặt biểu tượng cho marker thành redIcon
                    marker.setIcon(redIcon);

                }

                marker.openPopup();
                
                // Đóng modal
                $('#newPositionModal').modal('hide');
            } else {
                // Xử lý lỗi
                alert('Có lỗi xảy ra khi lưu dữ liệu.');
            }
        },
        error: function() {
            // Xử lý lỗi kết nối
            alert('Không thể kết nối đến máy chủ.');
        }
    });
});
//Chuc nang tim kiem
function searchTro(keyword) {
        for (var i = 0; i < troList.length; i++) {
            if (troList[i].info.toLowerCase().includes(keyword.toLowerCase())) {
                map.setView(troList[i].latlng, 18);
                // Tự động hiển thị popup
                var marker = L.marker(troList[i].latlng, { icon: redIcon }).addTo(map); // Tạo marker với biểu tượng null
                marker.bindPopup(troList[i].info);
                marker.openPopup(); 

                break;
            }
            else if (truongList[i].info.toLowerCase().includes(keyword.toLowerCase())) {
                map.setView(truongList[i].latlng, 18);
                // Tự động hiển thị popup
                var marker = L.marker(truongList[i].latlng, { icon: redIcon }).addTo(map); // Tạo marker với biểu tượng null
                marker.bindPopup(truongList[i].info);
                marker.openPopup(); 

                break;
            }
        }
    }

    document.getElementById("searchButton").addEventListener("click", function() {
        var keyword = document.getElementById("searchInput").value;
        searchTro(keyword);
    });

</script>
