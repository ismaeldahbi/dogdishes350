
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>BMCC Dog Dishes</title>

    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    />

    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" 
        rel="stylesheet"
    />
    <style>
    body {
        background-color: #f5e7b5;
    }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
        <a class="navbar-brand fw-bold" href="#">BMCC DOG DISHES</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="products.php">Products</a>
                <a class="nav-link" href="login.php">Login</a>
                <a class="nav-link" href="register.php">Register</a>
                <a class="nav-link" href="cart.php">Cart</a>
                
            </div>
        </div>
    </nav>

    <div class="text-center mt-4">
        <h1 class="text-center mb-4" style="font-family: 'Century Gothic', Arial, sans-serif; color:#43423F;">
                A look at our satisfied customers
        </h1>
        <img src="images/dogs-bg2.png" class="img-fluid" style="max-width:650px;" alt="dogs">
        <img src="images/dogs-bg3.png" class="img-fluid" style="max-width:500px;" alt="dogs">
       
    </div>

    <div class="container my-5">
        <div class="card p-4 shadow" >
            <h1 class="text-center mb-4" style="font-family: 'Century Gothic', Arial, sans-serif; color:#43423F;">
                About Us
            </h1>

            <div class="d-flex mb-4">
                <img src="images/alexbarker.png" class="rounded me-3" width="200" alt="team member">
                <div>
                    <h5 class="fw-bold mb-1">Alex Barker</h5>
                    <p class="mb-1"><strong>Role:</strong> Dog Food Designer</p>
                    <p class="mb-1"><strong>Email:</strong> alex.barker@bmcc.cuny.edu</p>
                    <p class="mb-0">
                        Created the recipe lineup for all dog dishes. Ensures meals are healthy,
                        balanced, and delicious for pups.
                    </p>
                </div>
            </div>

            <div class="d-flex">
                <img src="images/samantha.png" class="rounded me-3" width="200" alt="team member">
                <div>
                    <h5 class="fw-bold mb-1">Samantha Paws</h5>
                    <p class="mb-1"><strong>Role:</strong> Quality Tester</p>
                    <p class="mb-1"><strong>Email:</strong> samantha.paws@bmcc.cuny.edu</p>
                    <p class="mb-0">
                        Checks each dog dish for quality, presentation, and pup approval. Also
                        responsible for handling user feedback.
                    </p>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>