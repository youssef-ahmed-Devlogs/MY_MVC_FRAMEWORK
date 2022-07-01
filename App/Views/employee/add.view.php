<div class="container my-4">
    <h1 class="display-1">Add Employee</h1>
    <form action="/employee/insert" method="POST">
        <input type="text" name="name" class="form-control mb-2" placeholder="Name">
        <input type="text" name="age" class="form-control mb-2" placeholder="Age">
        <input type="text" name="address" class="form-control mb-2" placeholder="Address">
        <input type="text" name="salary" class="form-control mb-2" placeholder="Salary">
        <input type="text" name="tax" class="form-control mb-2" placeholder="Tax">
        <button class="btn btn-primary">Add Employee</button>
    </form>
</div>