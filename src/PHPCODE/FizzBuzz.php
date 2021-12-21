<?php

///////////////////////////////////////////////////
//                                               //
//            FizzBuzz検証クラス                   //
//                                               //
///////////////////////////////////////////////////

class FizzBuzz {
    public function kuso($test_value){

        $test_message = "normal";

        ///////////////////////////////////////////////////
        //                                               //
        //        データベースからFizzBuzzデータを取得        //
        //                                               //
        //       FizzBuzzテーブルは                        //
        //           ____________________                //
        //           |  id  |  message  |                //
        //           -------|-----------|                //
        //           |   1  |  normal   |                //
        //           |   2  |  normal   |                //
        //           |   3  |  Fizz     |                //
        //           |   4  |  normal   |                //
        //           |   5  |  Buzz     |                //
        //           |   ⋮  |    ⋮ 　　  |                //
        //           |  15  |  FizzBuzz |                //
        //           |   ⋮  |    ⋮       |                //
        //           |______|___________|                //
        //      となっている(100件のデータ)                  //
        //                                               //
        ///////////////////////////////////////////////////

        try {
            // DB接続
            $pdo = new PDO('mysql:host=db;dbname=test;','root','test',
                // レコード列名をキーとして取得させる
                [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
            );

            $sql = "SELECT * FROM FizzBuzz";
            $stmt = $pdo->query($sql);

            // FizzBuzz検証用のデータを取得
            $fizzbuzz_database_table = $stmt->fetchAll(PDO::FETCH_ASSOC|PDO::FETCH_UNIQUE);

        } catch (PDOException $e) {
            echo $e->getMessage();
        } finally {
            $pdo = null;
        }

        ///////////////////////////////////////////////////
        //                                               //
        //        csvデータからFizzBuzzデータを取得     　   //
        //                                               //
        //       FizzBuzz_csvデータは                     //
        //           ____________________                //
        //           |  キー |  message  |                //
        //           -------|-----------|                //
        //           |   1  |  normal   |                //
        //           |   2  |  normal   |                //
        //           |   3  |  Fizz     |                //
        //           |   4  |  normal   |                //
        //           |   5  |  Buzz     |                //
        //           |   ⋮  |    ⋮ 　　  |                //
        //           |  15  |  FizzBuzz |                //
        //           |   ⋮  |    ⋮       |                //
        //           |______|___________|                //
        //      となっている(100件のデータ)                  //
        //                                               //
        ///////////////////////////////////////////////////

        $file = fopen("./fizzbuzz.csv", "r");

        $fizzbuzz_csv = [];
        /* ファイルを1行ずつ出力 */
        if($file){
            $i = 1;
            while ($line = fgets($file)) {
                $fizzbuzz_csv[$i] = ['message' => (String)$line];
                $i++;
            }
        }
        /* ファイルポインタをクローズ */
        fclose($file);


        ///////////////////////////////////////////////////
        //                                               //
        //       FizzBuzz検証用のローカルテーブルを作成       //
        //                                               //
        //       FizzBuzzローカルテーブルは                 //
        //           ____________________                //
        //           |  キー |  message  |                //
        //           -------|-----------|                //
        //           |   1  |  normal   |                //
        //           |   2  |  normal   |                //
        //           |   3  |  Fizz     |                //
        //           |   4  |  normal   |                //
        //           |   5  |  Buzz     |                //
        //           |   ⋮  |    ⋮ 　　  |                //
        //           |  15  |  FizzBuzz |                //
        //           |   ⋮  |    ⋮       |                //
        //           |______|___________|                //
        //      となっている(100件のデータ)                  //
        //      データ形式は連想配列                         //
        //                                               //
        ///////////////////////////////////////////////////

        $fizzbuzz_local_table = [];
        for($i = 1;$i <= 100;$i++){
            if ($i % 3 == 0 && $i % 5 == 0) {
                $fizzbuzz_local_table[$i] = ['message' => "FizzBuzz"];
            } else if ($i % 3 == 0) {
                $fizzbuzz_local_table[$i] = ['message' => "Fizz"];
            } else if ($i % 5 == 0) {
                $fizzbuzz_local_table[$i] = ['message' => "Buzz"];
            } else {
                $fizzbuzz_local_table[$i] = ['message' => "normal"];
            }
        }


        ///////////////////////////////////////////////////
        //               メインプログラム                  //
        //               FizzBuzzの検証を開始             //
        //////////////////////////////////////////////////

        for($i = 1;$i <= 100;$i++){

            $fizzflug = false;
            $buzzflug = false;

            try {

                if($i % 3 == 0 && $i % 5 != 0 && $buzzflug != true){
                    if($fizzbuzz_local_table[$i]['message'] == "Fizz"){
                        throw new FizzException("Fizz",$i);
                    }
                } else if($i % 3 != 0 && $i % 5 == 0 && $fizzflug != true){
                    if($fizzbuzz_local_table[$i]['message'] == "Buzz"){
                        throw new BuzzException("Buzz",$i);
                    }
                }else if($i % 3 == 0 && $i % 5 == 0){
                    if($fizzbuzz_local_table[$i]['message'] == "FizzBuzz"){
                        throw new FizzBuzzException("FizzBuzz",$i);
                    }
                } else {
                    echo $i . "\n";
                }

            }catch(FizzException $fizzex) {
                $fizzflug = $fizzex->getTrueFlug();
                $id = $fizzex->getCode();
                $message = $fizzex->getMessage();
                if($fizzbuzz_database_table[$id]['message'] == $fizzbuzz_local_table[$i]['message']
                    && $fizzbuzz_database_table[$id]['message'] == $message){

                    $string_validation = new StringValidation($message);
                    if($string_validation->fizz_check()){
                        if($id == $test_value){
                            $test_message = $message;
                        }
                        echo $message . "\n";
                    }else {
                        $string_error = new StringError();
                        $string_error->fizz_error();
                    }
                }else {
                    $string_error = new StringError();
                    $string_error->fizz_error();
                }
            }catch(BuzzException $buzzex) {
                $buzzflug = $buzzex->getTrueFlug();
                $id = $buzzex->getCode();
                $message = $buzzex->getMessage();
                if($fizzbuzz_database_table[$id]['message'] == $fizzbuzz_local_table[$i]['message']
                    && $fizzbuzz_database_table[$id]['message'] == $message){
                    
                    $string_validation = new StringValidation($message);
                    if($string_validation->buzz_check()){
                        if($id == $test_value){
                            $test_message = $message;
                        }
                        echo $message . "\n";
                    }else {
                        $string_error = new StringError();
                        $string_error->buzz_error();
                    }
                }else {
                    $string_error = new StringError();
                    $string_error->buzz_error();
                }
            }catch(FizzBuzzException $fizzbuzzex){
                $id = $fizzbuzzex->getCode();
                $message = $fizzbuzzex->getMessage();
                if($fizzbuzz_database_table[$id]['message'] == $fizzbuzz_local_table[$i]['message']
                    && $fizzbuzz_database_table[$id]['message'] == $message){
                    
                    $string_validation = new StringValidation($message);
                    if($string_validation->fizzbuzz_check()){
                        if($id == $test_value){
                            $test_message = $message;
                        }
                        echo $message . "\n";
                    }else {
                        $string_error = new StringError();
                        $string_error->fizzbuzz_error();
                    }
                }else {
                    $string_error = new StringError();
                    $string_error->fizzbuzz_error();
                }
            }
        }

        return $test_message;
    }
}

///////////////////////////////////////////////////
//                                               //
//           FizzBuzzの例外クラス                  //
//                                               //
///////////////////////////////////////////////////

class FizzException extends Exception {
 
    public function __construct($message,$id) {
        parent::__construct($message,$id);
    }

    public function getTrueFlug() {
        return true;
    }

    public function __getCode() {
        return $this->id;
    }

    public function __getMessage() {
        return $this->message;
    }
}

class BuzzException extends Exception {
 
    public function __construct($message,$id) {
        parent::__construct($message,$id);
    }

    public function getTrueFlug() {
        return true;
    }

    public function __getCode() {
        return $this->id;
    }

    public function __getMessage() {
        return $this->message;
    }
}

class FizzBuzzException extends Exception {
 
    public function __construct($message,$id) {
        parent::__construct($message,$id);
    }

    public function __getCode() {
        return $this->id;
    }

    public function __getMessage() {
        return $this->message;
    }
}

///////////////////////////////////////////////////
//                                               //
//           FizzBuzz正規表現チェック               //
//                                               //
///////////////////////////////////////////////////

class StringValidation {

    private $message;

    public function __construct($message) {
        $this->message = $message;
    }

    public function fizz_check(){
        return preg_match("/^Fizz$/", $this->message);
    }

    public function buzz_check(){
        return preg_match("/^Buzz$/", $this->message);
    }

    public function fizzbuzz_check(){
        return preg_match("/^FizzBuzz$/", $this->message);
    }
}

///////////////////////////////////////////////////
//                                               //
//           FizzBuzz不一致エラー                  //
//                                               //
///////////////////////////////////////////////////

class StringError {
    public function fizz_error(){
        while(true){
            echo "それホントにFizzなの?";
        }
    }

    public function buzz_error(){
        while(true){
            echo "それホントにBuzzなの?";
        }
    }

    public function fizzbuzz_error(){
        while(true){
            echo "それホントにFizzBuzzなの?";
        }
    }
}
?>