<?php
// hapus session ketika logout
session_start();
session_destroy();

header("location:./");