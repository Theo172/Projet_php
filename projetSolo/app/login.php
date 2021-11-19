<?php 
    require "_bootstrap.php";
    require "includes/config.php";
    include "_head.php";
    ?>


<body>
    <?php 
    include "_navbar.php";
    ?>

    <section class="d-flex justify-content-around">


        <form class="w-25 py-5" method="POST" action="login_post.php">
            <h2 class="pb-5">Connect form</h2>
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" name="userName" class="form-control" aria-describedby="emailHelp">

            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="userPassword" class="form-control">
            </div>

            <button type="submit" name="submitLog" class="btn btn-primary">Submit</button>
        </form>







        <form class="w-25 py-5" method="POST" action="login_post.php">
            <h2 class="pb-5">Register</h2>
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" aria-describedby="emailHelp">

            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="pass" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="pass2" class="form-control">
            </div>
            <button type="submit" name="submitSign" class="btn btn-primary">Submit</button>
        </form>


    </section>

    <?php 
    include "_footer.php";
    ?>
</body>