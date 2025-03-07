<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Registrasi</title>
    <link href="<?= base_url('assets/img/logo_air.png')?>" rel="icon">
    <link href="<?= base_url('assets/img/logo_air.png')?>" rel="logo">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/my-login.css')?>">
</head>
<body class="my-login-page">
<section class="h-100">
    <div class="container h-100">
        <div class="row justify-content-md-center align-items-center h-100">
            <div class="col-xl-8 col-lg-10 col-md-10">
                    <div class="brand text-center mt-3">
                        <img src="<?= base_url('assets/img/logo_air.png')?>" alt="Logo" style="max-width: 100px;">
                    </div>
                    <div class="card fat">
                        <div class="card-body">
                            <h4 class="card-title text-center">Register</h4>
                            <form action="<?= base_url('/register/save') ?>" method="post" enctype="multipart/form-data" class="my-login-validation">
                                <?= csrf_field(); ?>

                                <div class="mb-3">
                                    <label>ID Meteran (Otomatis)</label>
                                    <input type="text" class="form-control" name="id_meteran" value="<?= $id_meteran ?>" readonly>
                                </div>

                                <div class="mb-3">
                                    <label>Foto</label>
                                    <input type="file" class="form-control" name="foto" accept="image/*">
                                </div>

                                <div class="mb-3">
                                    <label>NIK</label>
                                    <input type="text" class="form-control" name="nik" required>
                                </div>

                                <div class="mb-3">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="nama" required>
                                </div>

                                <div class="row">  
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>RT</label>
                                            <input type="number" class="form-control" name="rt" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>RW</label>
                                            <input type="number" class="form-control" name="rw" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label>Alamat</label>
                                    <textarea class="form-control" name="alamat" required></textarea>
                                </div>

                                <div class="row">  
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>No HP</label>
                                            <input type="text" class="form-control" name="no_hp" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password" required data-eye>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">Daftar</button>
                            </form>
                        </div>
                    </div>

                    <div class="footer text-center mt-3">
                        Copyright &copy; 2025 &mdash; Perusahaan Air Minum
                    </div>
            </div>
        </div>
    </div>
</section>


	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script>
        $(function() {
        $("input[type='password'][data-eye]").each(function(i) {
            var $this = $(this),
                id = 'eye-password-' + i,
                el = $('#' + id);

            $this.wrap($("<div/>", {
                style: 'position:relative',
                id: id
            }));

            $this.css({
                paddingRight: 60
            });
            $this.after($("<div/>", {
                html: 'Show',
                class: 'btn btn-primary btn-sm',
                id: 'passeye-toggle-'+i,
            }).css({
                    position: 'absolute',
                    right: 10,
                    top: ($this.outerHeight() / 2) - 12,
                    padding: '2px 7px',
                    fontSize: 12,
                    cursor: 'pointer',
            }));

            $this.after($("<input/>", {
                type: 'hidden',
                id: 'passeye-' + i
            }));

            var invalid_feedback = $this.parent().parent().find('.invalid-feedback');

            if(invalid_feedback.length) {
                $this.after(invalid_feedback.clone());
            }

            $this.on("keyup paste", function() {
                $("#passeye-"+i).val($(this).val());
            });
            $("#passeye-toggle-"+i).on("click", function() {
                if($this.hasClass("show")) {
                    $this.attr('type', 'password');
                    $this.removeClass("show");
                    $(this).removeClass("btn-outline-primary");
                }else{
                    $this.attr('type', 'text');
                    $this.val($("#passeye-"+i).val());				
                    $this.addClass("show");
                    $(this).addClass("btn-outline-primary");
                }
            });
        });

        $(".my-login-validation").submit(function() {
            var form = $(this);
            if (form[0].checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            }
            form.addClass('was-validated');
        });
        });
    </script>
</body>
</html>