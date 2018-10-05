using System; // System lets you use Console#WriteLine(), like System.out.println()...

namespace Test1 // "package" like in java
{
    internal class Driver
    {
        public static void Main(string[] args)
        {
            Console.WriteLine("Hello world");
            Console.WriteLine("Press any key to continue");
            Console.ReadKey();
            Console.WriteLine();
            Console.Write("Please enter your name: ");
            Console.WriteLine();
            string name = Console.ReadLine();
            Console.WriteLine("Hi " + name + "!");
            
            User grr = new User("Gustavo Rodriguez-Rivera", "grr@purdue.edu", 40);
            Console.WriteLine(grr);
        }
    }
}