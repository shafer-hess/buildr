using System;

namespace buildrFiles {

    public class Tests
    {

        static void Main(string[] args) {
       
            User u1 = new User(1, "Shafer", "Hess", "shafer_", "shafer.hess01@gmail.com", "testPass");
            
            Console.WriteLine("========== Test User Getters ==========");
            
            Console.WriteLine(u1.getFirstName());
            Console.WriteLine(u1.getLastName());
            Console.WriteLine(u1.getUsername());
            Console.WriteLine(u1.getEmail());
            
            Console.WriteLine("========== End Test Getters ==========");
            
            Console.WriteLine();
            
            Console.WriteLine("========== Test User Follows ==========");
            
            u1.follow("user_new");
            u1.follow("user_new2");
            u1.follow("user_new"); //Should generate error
            
            Console.WriteLine();
            
            u1.printFollows();
            
            Console.WriteLine("========== End Test Follows ==========");
        }
    }
    
}