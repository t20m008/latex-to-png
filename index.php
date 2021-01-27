<!DOCTYPE html>
<!-- KaTeX requires the use of the HTML5 doctype. Without it, KaTeX may not render properly -->

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/box.css?;">
        <!-- KaTeX -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.css" integrity="sha384-wITovz90syo1dJWVh32uuETPVEtGigN07tkttEqPv+uR2SE/mbQcG7ATL28aI9H0" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.js" integrity="sha384-/y1Nn9+QQAipbNQWU65krzJralCnuOasHncUFXGkdwntGeSvQicrYkiUBwsgUqc1" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/contrib/auto-render.min.js"></script>
        <script>// <![CDATA[
        document.addEventListener("DOMContentLoaded", function(){
        renderMathInElement(
            document.body,{
            delimiters: [
                {left: "$$", right: "$$", display: true},
                {left: "$", right: "$", display: false}]})});
        // ]]></script>

        <!-- jQuery CDN -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <!-- BS4 -->
        <!-- viewport meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
 
    </head>


    <body>
        <title>Convert LaTeX to PNG</title>
        <h1>Convert LaTeX to PNG</h1>
        <h3>入力</h3>
        <form action="index.php" method="post" id="AjaxForm">
            <textarea id="form" name="formula" cols="40" rows="5" placeholder="ここに数式を入力">\sin x = x-\frac{x^3}{3!}+\frac{x^5}{5!}\cdots</textarea>
            
            <br>
            <input type="submit" name="generate" value="Generate" />
            <input type="button"  value="Clear" onclick="clearTextarea()" />
            <br><br>

        </form>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" async=""></script>


        <h3>出力</h3>
        <table>
            <tr>
                <th>input</th> <th>KaTeX</th>
            </tr>

            <tr>
                <td>
                    <?php
                        $var = $_POST['formula'];
                        echo $var;
                    ?>
                </td> 
                <td>
                    <?php echo "$$".$_POST['formula']."$$";//echo '$$'.$var.'$$';?>
                </td>

            </tr>
            <tr>
                <th colspan="2">PNG</th>
            </tr>
            <tr>
                <td colspan="2">
                    <?php
                        session_start();
                        $file = uniqid(rand()."_");
                        $fg = 0;
                        if (isset($var) && $var!="") {
                            exec("sudo php generate.php"." '".$var."' ".$file);
                            echo("<img border=\"0\" src=\"img/${file}.png\" alt=\"f\">");
                            $fg = 1;
                        } else {
                            //echo "PNG";
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <?php if($fg==1)echo("<a href= \"http://kiwi.hig3.net/latex/img/${file}.png\" >${file}</a>"); ?>
                </td>
            </tr>
        </table>


        <br><br>
        <h3>サンプル</h3>
        <table>
            <tr>
                <th>例</th><th>コピー</th>
            </tr>
            <tr>
             <td><img src="img/sample/s1.png" width="10%" alt="f"></td>
             <td>
              <div class="container-fluid mx-0">
               <div class="form-group row">
                <textarea class="border border-info rounded text-secondary form-control-plaintext col-5" id="CopyTarget1" type="text" value="CopyTarget1" readonly>\frac{d^n y}{dx^n}</textarea>
                 <button type="button" class="btn btn-info col" onclick="Copy1()" data-toggle="tooltip" data-placement="top" title="コピーする">
                  <i class="fas fa-clipboard"></i>
                </button>
               </div>
              </div>
             </td>
            </tr>
            <tr>
             <td><img src="img/sample/s2.png" width="50%" alt="f"></td>
             <td>
              <div class="container-fluid mx-0">
               <div class="form-group row">
                <textarea class="border border-info rounded text-secondary form-control-plaintext col-5" id="CopyTarget2" type="text" value="CopyTarget2" readonly>\overline{ (A\cap B) } = \overline{ A } \cup \overline{ B }</textarea>
                 <button type="button" class="btn btn-info col" onclick="Copy2()" data-toggle="tooltip" data-placement="top" title="コピーする">
                  <i class="fas fa-clipboard"></i>
                </button>
               </div>
              </div>
             </td>
            </tr>
            <tr>
             <td><img src="img/sample/s3.png" width="50%" alt="f"></td>
             <td>
              <div class="container-fluid mx-0">
               <div class="form-group row">
                <textarea class="border border-info rounded text-secondary form-control-plaintext col-5" id="CopyTarget3" type="text" value="CopyTarget3" readonly>\int_0^1 x dx = \left[ \frac{x^2}{2} \right]_0^1 = \frac{1}{2}</textarea>
                 <button type="button" class="btn btn-info col" onclick="Copy3()" data-toggle="tooltip" data-placement="top" title="コピーする">
                  <i class="fas fa-clipboard"></i>
                </button>
               </div>
              </div>
             </td>
            </tr>
            <tr>
             <td><img src="img/sample/s4.png" width="50%" alt="f"></td>
             <td>
              <div class="container-fluid mx-0">
               <div class="form-group row">
                <textarea class="border border-info rounded text-secondary form-control-plaintext col-5" id="CopyTarget4" type="text" value="CopyTarget4" readonly>
                A = \left(
                    \begin{array}{cccc}
                        a_{ 11 } & a_{ 12 } & \ldots & a_{ 1n } \\
                        a_{ 21 } & a_{ 22 } & \ldots & a_{ 2n } \\
                        \vdots & \vdots & \ddots & \vdots \\
                        a_{ m1 } & a_{ m2 } & \ldots & a_{ mn }
                    \end{array}
                    \right)
                </textarea>
                 <button type="button" class="btn btn-info col" onclick="Copy4()" data-toggle="tooltip" data-placement="top" title="コピーする">
                  <i class="fas fa-clipboard"></i>
                </button>
               </div>
              </div>
             </td>
            </tr>
            <tr>
             <td><img src="img/sample/s5.png" width="50%" alt="f"></td>
             <td>
              <div class="container-fluid mx-0">
               <div class="form-group row">
                <textarea class="border border-info rounded text-secondary form-control-plaintext col-5" id="CopyTarget5" type="text" value="CopyTarget5" readonly>
                \max ( a, b )
                =
                \begin{cases}
                    a & ( a \geqq b ) \\
                    b & ( a \lt b )
                \end{cases}
                </textarea>
                 <button type="button" class="btn btn-info col" onclick="Copy5()" data-toggle="tooltip" data-placement="top" title="コピーする">
                  <i class="fas fa-clipboard"></i>
                </button>
               </div>
              </div>
             </td>
            </tr>
        </table>
        
        <br>
        <h3>実行中のユーザー名</h3>
        <?php
            $user = exec('whoami');
            $group = exec('groups ' .$user);
            echo "ユーザー:{$user}<br>";
            echo "グループ:{$group}<br>";
        ?>
        <!-- textarea copy -->
        <script>
            function Copy1() {
                // コピー対象をJavaScript上で変数として定義する
                var copyTarget = document.getElementById("CopyTarget1");

                // コピー対象のテキストを選択する
                copyTarget.select();

                // 選択しているテキストをクリップボードにコピーする
                document.execCommand("Copy");

                // コピーをお知らせする
                alert("コピー済みです : " + copyTarget.value);
            }
            function Copy2() {
                // コピー対象をJavaScript上で変数として定義する
                var copyTarget = document.getElementById("CopyTarget2");

                // コピー対象のテキストを選択する
                copyTarget.select();

                // 選択しているテキストをクリップボードにコピーする
                document.execCommand("Copy");

                // コピーをお知らせする
                alert("コピー済みです : " + copyTarget.value);
            }
            function Copy3() {
                // コピー対象をJavaScript上で変数として定義する
                var copyTarget = document.getElementById("CopyTarget3");

                // コピー対象のテキストを選択する
                copyTarget.select();

                // 選択しているテキストをクリップボードにコピーする
                document.execCommand("Copy");

                // コピーをお知らせする
                alert("コピー済みです : " + copyTarget.value);
            }
            function Copy4() {
                // コピー対象をJavaScript上で変数として定義する
                var copyTarget = document.getElementById("CopyTarget4");

                // コピー対象のテキストを選択する
                copyTarget.select();

                // 選択しているテキストをクリップボードにコピーする
                document.execCommand("Copy");

                // コピーをお知らせする
                alert("コピー済みです : " + copyTarget.value);
            }
            function Copy5() {
                // コピー対象をJavaScript上で変数として定義する
                var copyTarget = document.getElementById("CopyTarget5");

                // コピー対象のテキストを選択する
                copyTarget.select();

                // 選択しているテキストをクリップボードにコピーする
                document.execCommand("Copy");

                // コピーをお知らせする
                alert("コピー済みです : " + copyTarget.value);
            }
        </script>

        <!-- textarea clear -->
        <script>
            function clearTextarea() {
                var textareaForm = document.getElementById("form");
            textareaForm.value = '';
            }
        </script>

        <!-- jQuery、Popper.js、Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    </body>

</html>