public class FizzBuzz {
    public static void main(String[] args){
        for (int i = 1; i <= 100; i++) {
            if (i % 3 == 0 && i % 5 == 0) {
                System.out.println("Fizz Buzz");
            } else if (i % 3 == 0) {
                System.out.println("Fizz");
            } else if (i % 5 == 0) {
                System.out.println("Buzz");
            } else {
                System.out.println(i);
            }
        }
    }
}

public static void useForLoopWithTertiaryOperator(int end = 100) {
    for (int i = 1; i <= end; i++) {
        System.out.println(
            (i % 3 == 0 && i % 5 == 0) ? "Fizz Buzz" : ( i % 3 == 0) ? "Fizz" : (i % 5 == 0) ? "Buzz" : i
        );
    }
}

public static void useStreamAPI(int end = 100) {
    IntStream.rangeClosed(1, end)
        .mapToObj(i -> (i % 3 == 0 && i % 5 == 0) ? "Fizz Buzz" : (i % 3 == 0) ? "Fizz" : (i % 5 == 0) ? "Buzz" : i)
        .forEach(msg -> System.out.println(msg));
}