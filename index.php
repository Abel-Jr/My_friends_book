<html>
    
    <head>
    <title> My friends book </title>
    <link rel ="stylesheet" href ="index.css">
    </head>

    <header id = "header">
        <h1 id ="book"> My friends book </h1>
    </header>
    <body>
        <br/><br/>
        <form action="index.php" method="POST">
            Name: <input type="text" name="name" id="name" >
            <input type="submit" value="Add new friend">
        </form>
    
        <?php
            $friends =array();
            $filename = 'friends.txt';
               
            echo "<h1> My Best Friends : </h1>";





            // appending to file
            if ((!empty($_POST["name"])) && (isset($_POST["name"])!=null ) ) {
                $file = fopen( $filename, "a" );
                $line = fgets($file);
                $result = $_POST['name'];
                if(strlen($result)>0){
                    fwrite( $file, "$result \n" );
                    $friends[]=$_POST["name"];
                }
                        
                fclose($file);
   
            }





            //reading file and lines to the array;  notice that i start the count at 1

            $file = fopen( $filename, "r" );
            $count=1;
            echo ("<ul class = ". "test>");
            while (!feof($file)) {
    
                $line = fgets($file);
                     
                $friends[]=$line;
                if (!empty($friends[$count])){
                    echo ("<li><h3>".$friends[$count]."</h3></li>");
                }
                    
                $count++;
            }

            echo ("</ul>");
            fclose($file);
                 
 
               
        ?>

        <form action="index.php" method="POST">
            <input type="text" name="nameFilter" id="nameFilter"/>
            <input type ="checkBox" name="startingWith" id ="startingWith" value="TRUE" />
            Only names starting with &nbsp;
            <input type="submit" value="FilterList">
        </form>

        <?php
           
            if (isset($_POST["nameFilter"]) && ! empty($_POST["nameFilter"])){
                $filter_field = $_POST["nameFilter"];
                    
                // Check if the value that i looking for is not null

                if ($filter_field!=null) {
                    
                    // If the checkBox is selected

                    if(isset($_POST["startingWith"])){
                        $filter_field = $_POST["nameFilter"];
                        echo ("<ul class = "."test>");
            
                        for ($i=0; $i<sizeof($friends); $i++){
                            $position = strpos($friends[$i],$filter_field);
                            // I make sure that the position of the first occurence is at the beginning
                            if ($position===0){
                                            
                                echo ("<li><h3>".$friends[$i]."</h3></li>");
                            }
            
                                            
                        }
                        echo("</ul>");

                    }

                    else 
                    {    // If the checkBox is not selected
                                    
                        echo("\n");
                        echo ("<ul class = "."test>");

                        for ($i=0; $i<sizeof($friends); $i++){
                            $value = strstr($friends[$i],$filter_field);
                            // I make sure that the return value of my strstr function is not empty, if it is, it means that we can't have a substring into the string given        
                            if (!empty($value)){
                                echo ("<li><h3>".$friends[$i]."</h3></li>");
                            }
                        }
                        echo("</ul>");

                    }
                }
                           
             
            }
                                   
 
            ?>
       
        <br/> <br/>
        <footer id ="foot">
            <h3 id = "foo"> Footer </h3>
        </footer>

    </body>
        
</html>