import java.util.HashMap;

public class Kuso {
    public static void main(String[] args) throws Exception {

        HashMap<Integer, String> hashmap = new HashMap<>();

        for (int i = 1; i <= 100; i++) {
            if (i % 3 == 0 && i % 5 == 0) {
                hashmap.put(i, "FizzBuzz");
            } else if (i % 3 == 0) {
                hashmap.put(i, "Fizz");
            } else if (i % 5 == 0) {
                hashmap.put(i, "Buzz");
            } else {
                hashmap.put(i, "normal");
            }
        }

        System.out.println("[5] 値[0]:" + hashmap.get(1));
    
        

        for (int i = 1; i <= 100; i++) {

            boolean fizzflug = false;
            boolean buzzflug = false;

            try {
                
                if (i % 3 == 0) {
                    ThrowsFizzException();
                    System.out.println("Fizz");
                } else if (i % 5 == 0) {
                    System.out.println("Buzz");
                }else if (fizzflug == true && buzzflug == true) {

                } else {
                    System.out.println(i);
                }

            }catch(FizzException fizz) {
                fizzflug = fizz.getTrueFlug();
                System.out.print(fizz.getMessage());
            }catch(BuzzException buzz) {
                buzzflug = buzz.getTrueFlug();
                System.out.print(buzz.getMessage());
            }catch(FizzBuzzException fizzbuzz){
            }
        }
        
    }

    public static void ThrowsFizzException() throws Exception {
        throw new FizzException("Fizz");
    }

    public static void ThrowsBuzzException() throws Exception {
        throw new BuzzException("Buzz");
    }

    public static void ThrowsFizzBuzzException() throws Exception {
        throw new BuzzException("FizzBuzz");
    }
}

class FizzException extends Exception {
 
    private String message;

    FizzException(String message) {
        this.message = message;
    }

    public boolean getTrueFlug() {
        return true;
    }

    public String getMessage() {
        return this.message;
    }
}

class BuzzException extends Exception {
 
    private String message;

    BuzzException(String message) {
        this.message = message;
    }

    public boolean getTrueFlug() {
        return true;
    }

    public String getMessage() {
        return this.message;
    }
 
}

class FizzBuzzException extends Exception {
 
    private String message;

    FizzBuzzException(String message) {
        this.message = message;
    }

    public String getMessage() {
        return this.message;
    }
}