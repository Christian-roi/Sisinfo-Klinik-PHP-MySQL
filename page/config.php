<?php
    session_start();
    $mysqli = new mysqli(
        'localhost', 
        'root', 
        '', 
        'klinik'
    );

    function execute($sql)
    {
        $mysqli = $GLOBALS['mysqli'];
        // insert terima $hasil 
        $hasil = $mysqli->query($sql);
        // select terima $data 
        if (strtoupper(substr(trim($sql),0,6)) == "SELECT") {
            if ($hasil == false) {
                echo "<div class='alert alert-danger'>Terdapat Error: ".$mysqli->error."</div>";
                return [];
            } else {
                return $hasil->fetch_all(MYSQLI_ASSOC);
            }
        } else {
            if ($hasil == false) {
            echo "<div class='alert alert-danger'>Terdapat Error: " . $mysqli->error . "</div>";
            }
            return $hasil;
        }
    }

    function select($nama_table)
    {
        $sql = "SELECT * FROM $nama_table";
        if (strtoupper(substr(trim($nama_table),0,6)) == "SELECT") {
            $sql = $nama_table;
        }

        $data = execute($sql);
        return $data;
    }

    function save($nama_table, $data, $where = '')
    {
        $a = [];
        foreach ($data as $field => $value) {
            $a[] = " `$field` = '$value'";
        }

        $sql = "INSERT INTO $nama_table SET " . join(',', $a);
        if ($where != '')
            $sql = "UPDATE $nama_table SET " . join(',', $a) . " WHERE $where";
        return execute($sql);
    }

    function delete($nama_table, $where)
    {
        $sql = "DELETE FROM $nama_table WHERE $where";
        execute($sql);
    }


    function tabel($header, $data, $pk)
    {
        echo "\r\n<table id=\"myTable\" class=\"table table-stripped table-hover\">\r\n";
        echo "<thead>
                <tr>\r\n";
        echo "<th>No.</th>\r\n";
        foreach ($header as $i => $item) {
            if (isset($item['label'])) {
                echo "<th>" . $item['label'] . "</th>\r\n";
            } else {
                echo "<th>" . $item . "</th>\r\n";
            }
        }
        echo "<th>Aksi</th>\r\n";
        echo "</tr>\r\n
        </thead>
        <tbody>
        ";
        $no = 1;
        $page = ($_GET['page'] ?? '');
        foreach ($data as $val) {
            echo "<tr>\r\n";
            echo "<td>" . $no . "</td>\r\n";
            $no++;
            foreach ($header as $i => $item) {
                if (isset($item['tipe']) && $item['tipe'] == 'img')
                echo "<td><img src=\"" . $val[$i] . "\" style=\"width:50px;\"></td>\r\n";
                else
                    echo "<td>" . $val[$i] . "</td>\r\n";
            }
            echo "<td>
                <a class=\"btn btn-info\" href=\"?page=$page&act=edit&id=" . $val[$pk] . "\">
                    <i class=\"bi bi-pen\"></i>
                </a>
                <a class=\"btn btn-danger\" href=\"?page=$page&act=delete&id=" . $val[$pk] . "\">
                    <i class=\"bi bi-trash\"></i>
                </a>
                </td>\r\n";

            echo "</tr>\r\n";
        }
        echo "</tbody></table>\r\n";
    }


    function kelolafile($index_file, $folder)
    {
        if (isset($_FILES[$index_file])&& !$_FILES[$index_file]['error']) {
            $file_temp = $_FILES[$index_file]['tmp_name'];
            $file_nama = $folder . '/' . $_FILES[$index_file]['name'];
            move_uploaded_file(
                $file_temp,        
                $file_nama
            );
            $_POST['data'][$index_file] = $file_nama;
        }
    }
?>
