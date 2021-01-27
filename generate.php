<?php 

session_start();

// コマンドライン引数
$s = $argv[1];
$file = $argv[2];
//パラメータの取得

$formula = $s;

//$string = '\pi = 3.14 \ldots';
$string = $formula;

$r=0.0;
$g=0.0;
$b=0.0;
$br=1.0;
$bg=1.0;
$bb=1.0;

$format = "\\documentclass[14pt]{extarticle}\n".
          "\\usepackage{color}\n".
          "\\usepackage{amsmath}\n\\usepackage{amsfonts}\n\\usepackage{amssymb}\n".
          "\\pagestyle{empty}\n".
          "\\begin{document}\n".
          "\\color[rgb]{".$r.",".$g.",".$b."}\n".
          "\\pagecolor[rgb]{".$br.",".$bg.",".$bb."}\n".
          "$$".$string."$$\n".
          "\\end{document}\n";


// UID
//$file = $_SESSION["file"];
//$file = "img";
echo $file;

// change directory
chdir("img");

// .texファイルの生成
if ( ($tex = fopen("${file}.tex", "w+"))==FALSE) { return '[file access error]'; }
fwrite($tex, $format); 
fclose($tex);

// .texファイルのコンパイル
exec("/usr/bin/latex --interaction=nonstopmode ${file}.tex");

// .psファイルの生成
exec("dvips -o ${file}.ps ${file}.dvi");

// .pngファイルの生成
exec("convert -colorspace RGB -density 150 -trim -mattecolor white -frame 15x15 ${file}.ps ${file}.png");

unlink("${file}.aux");
unlink("${file}.dvi");
unlink("${file}.log");
unlink("${file}.ps");
unlink("${file}.tex");
?>

<html>
    <body>
        <?php echo "<img border=\"0\" src=\"./${file}.png\" alt=\"img\">" ?>
    </body>
</html>