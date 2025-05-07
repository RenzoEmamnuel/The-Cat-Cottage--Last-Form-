<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    .navbar {
        position: sticky;
        top: 30px;
        margin: 30px auto 0 auto; 
        width: 80%;
        background: #F5ECD5;
        padding: 5px;
        border-radius: 20px;
        text-align: center;
        z-index: 1000;
    }

    .navbar a, .navbar .btn {
        text-decoration: none;
        color: #333;
        font-size: 14px;
        font-weight: bold;
        margin: 0 15px;
        padding: 10px;
        border-radius: 20px;
        transition: 0.3s;
        display: inline-block;
        background: transparent;
        border: none;
    }

    .navbar a:hover, .navbar .dropdown-menu a:hover {
        background: #A4B465;
        color: white;
		border: none;
    }

    .dropdown-menu {
        border-radius: 20px;
    }
</style>

<div class="navbar">
    <a href="manage_users.php">Manage Users</a>
    <a href="manage_cats.php">Manage Cats</a>
    <a href="adoption_requests.php">Adoption Requests</a>
    <a href="review_submissions.php">Review Submitted Cats</a>
    <a href="history.php">History</a>
	<a href="../login.php">Log Out (Admin)</a>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
