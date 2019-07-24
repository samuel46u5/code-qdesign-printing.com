<?php echo $header; ?>
<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(<?php echo site_url('asset/img/uploads/banner/' . $bannertitlepage->image . '') ?>);">
    <h2 class="l-text2 t-center m-text-glow">
        Kontak
    </h2>
</section>

<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-50">
    <a href="<?php echo base_url('') ?>" class="s-text16">
        Home
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <span class="s-text17">
        Galery
    </span>
</div>

<!-- <?php var_dump($galery[2]); ?> -->

<section class="newproduct bgwhite p-t-30 p-b-35">
    <div class="container">


        <h2>Galery</h2> <br>
        <div id="myBtnContainer">
            <button class="btn active" onclick="filterSelection('all')"> Show all</button>
            <?php foreach ($album as $value) { ?>
                <button class="btn" onclick="filterSelection('<?php echo $value->nama_album ?>')"> <?php echo $value->nama_album; ?></button>
            <?php } ?>
        </div>

        <!-- Portfolio Gallery Grid -->
        <div class="row">
            <?php foreach ($galery as $value) { ?>
                <div class="column <?php echo $value->nama_album; ?>">

                    <div class="content">

                        <img src="<?php echo site_url('asset/img/uploads/galery/') . $value->image; ?>" class="bo18" alt="Mountains" style="width:100%">

                        <h4><?php echo $value->deskripsi; ?></h4>
                        <p><?php echo $value->deskripsi; ?></p>
                    </div>

                </div>
            <?php } ?>
            <!-- END GRID -->
        </div>
    </div>
</section>


<script>
    filterSelection("all") // Execute the function and show all columns
    function filterSelection(c) {
        var x, i;
        x = document.getElementsByClassName("column");
        if (c == "all") c = "";
        // Add the "show" class (display:block) to the filtered elements, and remove the "show" class from the elements that are not selected
        for (i = 0; i < x.length; i++) {
            w3RemoveClass(x[i], "show");
            if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
        }
    }

    // Show filtered elements
    function w3AddClass(element, name) {
        var i, arr1, arr2;
        arr1 = element.className.split(" ");
        arr2 = name.split(" ");
        for (i = 0; i < arr2.length; i++) {
            if (arr1.indexOf(arr2[i]) == -1) {
                element.className += " " + arr2[i];
            }
        }
    }

    // Hide elements that are not selected
    function w3RemoveClass(element, name) {
        var i, arr1, arr2;
        arr1 = element.className.split(" ");
        arr2 = name.split(" ");
        for (i = 0; i < arr2.length; i++) {
            while (arr1.indexOf(arr2[i]) > -1) {
                arr1.splice(arr1.indexOf(arr2[i]), 1);
            }
        }
        element.className = arr1.join(" ");
    }

    // Add active class to the current button (highlight it)
    var btnContainer = document.getElementById("myBtnContainer");
    var btns = btnContainer.getElementsByClassName("btn");
    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
        });
    }
</script>




<?php echo $footer; ?>
</body>

</html>