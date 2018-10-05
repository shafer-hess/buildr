using System;

namespace buildrFiles
{
    public class UserTests
    {
        static void Main(string[] args)
        {
            User u1 = new User(1, "Shafer", "Hess", "shafer_", "shafer.hess01@gmail.com", "testPass");
            Console.WriteLine(u1.getFirstName());
        }
    }
}