<?php include("nav.php"); ?>
<?php include("connections.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cat Adoption</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('path/to/your/background.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            font-family: 'Nunito', sans-serif;
        }

        .centered-container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 40px 0;
        }

        .blur-card {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            padding: 2rem;
            width: 80%;            /* wider to fit 4-per-row */
            margin: 0 auto;
        }

        .grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
        }

        .card {
            background-color: #f1f0d1;
            width: calc(25% - 20px);
            text-align: center;
            padding: 10px;
            border-radius: 8px;
            box-sizing: border-box;
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 4px;
        }

        .info {
            font-size: 14px;
            margin: 10px 0;
            text-align: left;
        }

        .btn {
            background-color: #a6c191;
            border: none;
            padding: 8px 16px;
            border-radius: 20px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn:hover {
            background-color: #8eaa7a;
        }

        @media (max-width: 1200px) {
            .card { width: calc(33.33% - 20px); }
        }
        @media (max-width: 768px) {
            .card { width: calc(50% - 20px); }
        }
        @media (max-width: 480px) {
            .card { width: 100%; }
            .blur-card { width: 95%; }
			
			
        }
    </style>
</head>
<script>
function checkAdoptionRequest(catId) {
    fetch('check_request.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'cat_id=' + catId
    })
    .then(response => response.text())
    .then(result => {
        if (result.trim() === 'exists') {
            alert("You have already requested to adopt this cat.");
        } else {
            window.location.href = 'adoption_form.php?cat_id=' + catId;
        }
    });
}
</script>


<body>

<div class="centered-container">
    <div class="blur-card shadow-lg">
        <h2 class="text-center mb-4">Available Cats for Adoption</h2>
        <div class="grid">
            <?php
            $query = mysqli_query($connections, "SELECT * FROM cats WHERE status='Available'");
            while ($row = mysqli_fetch_assoc($query)) {
                $image       = htmlspecialchars($row['image']);
                $name        = htmlspecialchars($row['name']);
                $breed       = htmlspecialchars($row['breed']);
                $age         = htmlspecialchars($row['age']);
                $sex         = htmlspecialchars($row['sex']);
                $neutered    = htmlspecialchars($row['neutered']);
                $vaccination = htmlspecialchars($row['vaccination']);
                $description = htmlspecialchars($row['description']);
                $id          = intval($row['id']);

                echo "
                <div class='card'>
                    <img src='{$image}' alt='Cat Image'>
                    <div class='info'>
					<center>
                        <strong>Name:</strong> {$name}<br>
                        <strong>Breed:</strong> {$breed}<br>
                        <strong>Age:</strong> {$age}<br>
                        <strong>Sex:</strong> {$sex}<br>
                        <strong>Neutered:</strong> {$neutered}<br>
                        <strong>Vaccination:</strong> {$vaccination}<br>
                        <strong>Description:</strong> {$description}
						</center>
                    </div>
                    <button class='btn' onclick='window.location.href=\"login.php?cat_id={$id}\"'>ADOPT</button>
                </div>
                ";
            }
            ?>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
