<div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Form Tambah Produk</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form">
                    <form name="sendMessage" action="<?php echo site_url('produk/save'); ?>" method="post" enctype="multipart/form-data">  
                    <input type="hidden" name="idToko" value="<?php echo $idToko;?>"> 
                        <div class="control-group">
                            <select class="form-control" name="kategori">
                                <?php foreach($kategori as $val){?>
                                    <option value="<?php echo $val->idkat; ?>"><?php echo $val->namaKat;?></option>
                                <?php } ?>
                            </select>
                                <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control" name="namaProduk" id="name" placeholder="Nama Produk"
                            required="required" data-validation-required-message="Please enter your name"/>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="file" class="form-control" name="gambar" id="emfail" placeholder="Gambar Produk"
                            required="required" data-validation-required-message="Please enter your image"/>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control" name="hargaProduk" id="name" placeholder="Harga Produk"
                            required="required" data-validation-required-message="Please enter your price"/>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control" name="jumlahProduk" id="name" placeholder="Jumlah Produk"
                            required="required" data-validation-required-message="Please enter your name"/>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control" name="beratProduk" id="name" placeholder="Berat Produk"
                            required="required" data-validation-required-message="Please enter your name"/>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <textarea row="3" class="form-control" name="deskripsi" id="message" placeholder="Deskripsi"
                            required="required" data-validation-required-message="Please enter your message"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>