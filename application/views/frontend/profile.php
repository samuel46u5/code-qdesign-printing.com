<?php echo $header; ?>
<div class="bread-crumb-detail bgwhite flex-w p-l-52 p-r-15 p-t-50 p-l-15-sm">
    <a href="<?php echo base_url('') ?>" class="s-text16">
        Home
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <span class="s-text17">
        Data User
    </span>
</div>
<section class="bgwhite p-t-66 p-b-38">
    <div class="container">
        <div class="row">
            <div class="col-md-4 p-b-30">
                <div class="hov-img-zoom">
                    <img src="<?php echo base_url('asset/img/user.jpg') ?>" alt="IMG-ABOUT">
                </div>
            </div>
            <div class="col-md-8 p-b-30">
                <h3 class="m-text26 p-t-15 p-b-16">
                    <?php echo "Selamat Datang, " . $user->username; ?>
                </h3>
                <p class="p-b-28">
                <table style="width: 100%;">
                    <tr>
                        <td>Nama</td>
                        <td><?php echo $user->username; ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo $user->useremail; ?></td>
                    </tr>
                    <tr>
                        <td>Provinsi</td>
                        <td><?php echo $user->provinsi; ?></td>
                    </tr>
                    <tr>
                        <td>Kabupaten</td>
                        <td><?php echo $user->kabupaten; ?></td>
                    </tr>
                    <tr>
                        <td>No Telephone</td>
                        <td><?php echo $user->userHp; ?></td>
                    </tr>
                    <tr>
                        <td>Tipe User</td>
                        <td><?php echo $user->tipeuser; ?></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td><?php echo $user->userStatus; ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Join</td>
                        <td><?php echo $user->joindate; ?></td>
                    </tr>
                </table>
                </p>
                <p class="p-b-28">
                <table style="width: 100%;">
                    <tr>
                        <td><a class="btn btn-danger btn-sm" href="<?php echo base_url('User/logout')?>">logout <i class="fa fa-sign-out"></i></a></td>
                    </tr>
                </table> 
                </p>
            </div>
        </div>
    </div>
</section>
<?php echo $footer; ?>
</body>
</html>