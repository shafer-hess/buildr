using System;
using System.Collections.Generic;
using System.Runtime.InteropServices.ComTypes;

namespace buildrFiles
{
    public class followList
    {
        private int count;
        private List<User> users;

        public followList()
        {
            count = 0;
            users = new List<User>();
        }

        public List<User> getUserList()
        {
            return users;
        }
        
        public void addFollow(User usr)
        {
            if (!users.Contains(usr))
            {
                users.Add(usr);
                count++;   
            }
            else
            {
                Console.WriteLine("You already follow: " + usr.getUsername());
            }
        }

        public void removeFollow(User usr)
        {
            if (!users.Remove(usr))
            {
                Console.WriteLine("You do not follow: " + usr.getUsername()); 
            }
            else
            {
                count--;
            }
        }

        public User getUser(User usr) //by User object
        {
            foreach (var u in users)
            {
                if (usr.getUsername() == u.getUsername())
                {
                    return u;
                }
            }

            Console.WriteLine("User: " + usr.getUsername() + ", not found");
            return null;
        }

        public User getUser(int id) //by User ID
        {
            foreach (var u in users)
            {
                if (u.getID() == id)
                {
                    return u;
                }
            }
            
            Console.WriteLine("User with ID: " + id + ", not found");
            return null;
        }

        public void setFollows(int num)
        {
            count = num;
        }

        public int getFollows()
        {
            return count;
        }  
    }
}