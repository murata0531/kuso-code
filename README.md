# kuso-code

FizzBuzzをいかにクソにかけるかを確かめる

環境 : Java SE15

_____________________________________

コンテナ作成

```
$ docker-compose build
```

コンテナとイメージ破棄

```
$ docker-compose down --rmi all --volumes --remove-orphans
```

コンテナ起動

```
$ docker-compose up -d
```

コンテナに入る

```
$ docker-compose exec java bash
```

コンパイル(例としてMain.javaをコンパイルする)

```
bash# javac Main.java
```

実行(例としてMain.javaを実行する)

```
bash# java Main
```

windows環境ではdockerコマンドの前に「winpty」が必要かも

```
$ winpty docker-compose exec java bash
```