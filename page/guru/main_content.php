<section class="content">
    <div class="container-fluid">
        <?php
        // Mengambil nilai 'page' dari URL
        $page = isset($_GET['page']) ? $_GET['page'] : '';

        // Mengatur include file berdasarkan nilai 'page'
        switch ($page) {
            case 'add_soal':
                include('input/add_soal.php');
                break;
            case 'edit_soal':
                include('edit_soal.php');
                break;
            case 'view_soal':
                include('view_soal.php');
                break;
            default:
                include('content_guru.php'); // Default page
                break;
        }
        ?>
    </div>
</section>