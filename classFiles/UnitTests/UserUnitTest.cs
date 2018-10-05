using System;
using System.Reflection.Metadata;
using System.Collections.Generic;
using Xunit;

using buildrFiles;

namespace UnitTests
{
    public class UserUnitTest
    {
        
        User u1 = new User(1, "Shafer", "Hess", "shafer_", "shafer.hess01@gmail.com", "testPass");
        
        [Fact]
        public void testGetFirstName()
        {
            Assert.Equal("Shafer", u1.getFirstName());
        }

        [Fact]
        public void testGetLastName()
        {
            Assert.Equal("Hess", u1.getLastName());
        }

        [Fact]
        public void testGetUsername()
        {
            Assert.Equal("shafer_", u1.getUsername());
        }

        [Fact]
        public void testGetEmail()
        {
            Assert.Equal("shafer.hess01@gmail.com", u1.getEmail());
        }

        [Fact]
        public void testGetEmailInvalid()
        {
            User u2 = new User(2, "Test", "User", "tester_", "testinvalidgmail.com", "password");
            
            Assert.Equal("", u2.getEmail());
        }

        [Fact]
        public void testFollowList()
        {
            User u1 = new User(1, "Shafer", "Hess", "shafer_", "shafer.hess01@gmail.com", "testPass");
            User u2 = new User(2, "Test", "User", "tester_", "testinvalidgmail.com", "password");

            this.u1.follow(u2.getUsername());
            u2.follow(this.u1.getUsername());
            
            this.u1.follow("new_user");
            u2.follow("new_user");

            List<string> u1List = this.u1.getFollowList();
            List<string> u2List = u2.getFollowList();
            
            u1List.Sort();
            u2List.Sort();

            Assert.Equal(u1List.Count, u2List.Count);
            
            int flag = 0;
            for (var i = 0; i < u1List.Count; i++)
            {
                if (!u2List.Contains(u1List[i]) && u1List[i] != u2.getUsername()) 
                {
                    flag = 1;
                }   
            }
            
            Assert.Equal(0,flag);
        }  
    }
}