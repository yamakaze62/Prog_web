<HTML>

<head>
    <title>Table de Multiplication</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="tableMultiplication.css">
</head>

<body>
    <?php
        if(isset($_GET['Ligne'])) $ligne = $_GET['Ligne'];
        if(isset($_GET['Colonne'])) $colonne = $_GET['Colonne'];
    ?>
    <table>
        <thead style="background-color:yellow">
            <tr>
                <th></th>
                <?php for($i = 1; $i <= $colonne; $i++){ echo '<th>'.$i.'</th>';}?>
            </tr>
        </thead>
        <tbody>
            <?php for($i = 1; $i <= $ligne; $i++){
                    echo '<tr>' ; 
                    echo '<th>' .$i.'</th>'; 
                    for($j=1; $j <= $colonne; $j++){
                        echo '<td>'.$i*$j.'</td>'; 
                    } 
                        echo '</tr>' ; 
                } 
            ?>
            </tbody>
            </table>
</body>

</HTML>