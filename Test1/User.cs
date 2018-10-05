namespace Test1
{
    public class User
    {
        // class fields
        private string name;
        private string email;
        private int age;
        
        public User(string name, string email, int age) // constructor
        {
            this.name = name;
            this.email = email;
            this.age = age;
        }

        public string getName()
        {
            return this.name;
        }

        public void setName(string name)
        {
            this.name = name;
        }

        public string getEmail()
        {
            return this.email;
        }

        public void setEmail(string email)
        {
            this.email = email;
        }

        public int getAge()
        {
            return this.age;
        }

        public void setAge(int age)
        {
            this.age = age;
        }

        public override string ToString() // @Override for a toString() method like in Java
        {
            string result = "Name: " + this.name + "\nEmail: " + this.email + "\nAge: " + this.age;
            return result;
        }
    }
}