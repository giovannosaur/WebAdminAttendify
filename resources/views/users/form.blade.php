<div class="form-group">
    <label for="nama">Full Name</label>
    <input type="text" name="nama" id="nama" value="{{ old('nama', $user['nama'] ?? '') }}" required>
</div>

<div class="form-group">
    <label for="nama">Umur</label>
    <input type="integer" name="umur" id="umur" value="{{ old('umur', $user['umur'] ?? '') }}" required>
</div>

<div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" value="{{ old('email', $user['email'] ?? '') }}" required>
</div>

<div class="form-group">
    <label for="position">Position</label>
    <select name="position" id="position">
        <option value="IT Support">IT Support</option>
        <option value="Cybersecurity Analyst">Cybersecurity Analyst</option>
        <option value="Web Developer">Web Developer</option>
    </select>
</div>

<div class="form-group">
    <label for="status">Status</label>
    <select name="status" id="status">
        <option value="Active" {{ (old('status', $user['status'] ?? '') == 'Active') ? 'selected' : '' }}>Active</option>
        <option value="Inactive" {{ (old('status', $user['status'] ?? '') == 'Inactive') ? 'selected' : '' }}>Inactive</option>
    </select>
</div>

<div class="form-group">
    <label for="role">Role</label>
    <select name="role" id="role">
        <option value="admin">Admin</option>
        <option value="employee">Employee</option>
    </select>
</div>

