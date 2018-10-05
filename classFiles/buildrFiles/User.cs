using System;
using System.Collections.Generic;
        
        /*
            Add modelList when modelStorage class is created
            Add dwnldModels when modelStorage class is created
            Update followList to new data structure once class is created
         */

namespace buildrFiles {

    public class User {
    
        int id; //Generate ID from database
        string username;
        string nameFirst;
        string nameLast;
        string password; //talk to Derek about retrieving hashed passwords from php
        string userEmail;
        string profilePic; //filepath to local img (implement in unity)
        List<string> following;

        public User(int uid, string first, string last, string user, string email, string _password) {
            id = uid;
            setName(first, last);
            username = user;
            setEmail(email);
            //temp for testing purposed, final will include hashed password checking through database
            password = _password; 

            following = new List<string>();
        }

        public string getFirstName() {
            return nameFirst;
        }

        public string getLastName() {
            return nameLast;
        }

        public string getUsername() {
            return username;
        }

        public void setProfilePic(string path) {
            profilePic = path;
        }

        public void setName(string first, string last) {
            nameFirst = first;
            nameLast = last;
        }

        public string getEmail() {
            return userEmail;
        }
        
        public void setEmail(string email) {
            if(email.Contains("@")) {
                userEmail = email;
            }

            else {
                //change to visual error in Unity when UI is ready
                userEmail = "";
                Console.WriteLine("Invalid Email");
            }
        }

        public void follow(string username) {
            if(following.Contains(username) == false) {
                following.Add(username);
                Console.WriteLine("Followed: " + username);
            }

            else {
                //change to visual error in unity when UI is ready
                Console.WriteLine("You already follow this User: " + username);
            }
        }

        public List<string> getFollowList()
        {
            return following;
        }

        public void printFollows() {
             Console.WriteLine("Following:");
            foreach (var username in following)
            {
               Console.WriteLine(username); 
            }
        }
    }
}
