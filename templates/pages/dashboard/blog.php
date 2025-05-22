
<!-- MESSAGE SUCCESS AND ERROR DATA BLOG -->
<?php
if (isset($_SESSION['message'])):
    $type = $_SESSION['message']['type'];
    $text = $_SESSION['message']['text'];
?>
    <div id="flash-message" style="
        padding: 10px;
        margin-bottom: 15px;
        color: <?= $type === 'success' ? 'green' : 'red' ?>;
        border: 1px solid <?= $type === 'success' ? 'green' : 'red' ?>;
        border-radius: 5px;
        background-color: <?= $type === 'success' ? '#e6ffe6' : '#ffe6e6' ?>;
    ">
        <?= htmlspecialchars($text) ?>
    </div>

    <script>
        setTimeout(() => {
            const flash = document.getElementById('flash-message');
            if (flash) {
                flash.style.display = 'none';
            }
        }, 3000); // 3000ms = 3 detik
    </script>
<?php
    unset($_SESSION['message']);
endif;
?>

<div>
    <div class="heading-container">
        <h1>Blog</h1>
        <span class="btn-add">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-plus-icon lucide-circle-plus"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
            Add Blog
        </span>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title Blog</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Author</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td class="title-blog">Lorem ipsum dolor sit amet consectetur adipisicing elit.?</td>
                    <td class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. </td>
                    <td>10 Febuary 2025</td>
                    <td>John</td>
                    <td>
                        <div class="action">
                            <span class="btn-detail">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                            </span>

                            <span class="btn-edit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil-icon lucide-pencil"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="m15 5 4 4"/></svg>
                            </span>

                            <span class="btn-delete">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2-icon lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                            </span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Add Blog -->
<div id="addModal" class="modal">
  <div class="modal-content">
    <span class="btn-close" onclick="closeAddModal()">&times;</span>
    <h2>Add New Blog</h2>
    <form action="/dashboard/addBlog"" method="POST" id="addForm" enctype="multipart/form-data">

      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" required>
        <small id="titleError" class="error-message"></small>
      </div>

      <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" rows="2" required></textarea>
        <small id="descriptionError" class="error-message"></small>
      </div>

      <div class="form-group">
        <label for="date">Date</label>
        <input type="date" name="date" id="date" required>
      </div>

      <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image" id="image" accept="image/*" required>
      </div>

      <div class="form-actions">
        <input type="submit" value="Add" />
      </div>
    </form>
  </div>
</div>
