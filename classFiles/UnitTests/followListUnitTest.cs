using System;
using System.Reflection.Metadata;
using System.Collections.Generic;
using Xunit;

using buildrFiles;

namespace UnitTests
{
    public class followListUnitTest
    {

        [Fact]
        public void testAddFollow()
        {
            followList list = new followList();
            User u1 = new User(1, "Shafer", "Hess", "shafer_", "shafer.hess01@gmail.com", "testPass");
            
            list.addFollow(u1);

            List<User> userList = list.getUserList();
            
            Assert.Equal(u1.getUsername(), userList[0].getUsername());
        }

        [Fact]
        public void testRemoveFollow()
        {
            followList list = new followList();
            User u1 = new User(1, "Shafer", "Hess", "shafer_", "shafer.hess01@gmail.com", "testPass");
            User u2 = new User(2, "Test", "User", "tester_", "test_valid@gmail.com", "password");
            
            list.addFollow(u1);
            list.addFollow(u2);

            list.removeFollow(u1);

            List<User> userList = list.getUserList();

            int size = userList.Count;
            Assert.Equal(1, size);            
            Assert.Equal(1, list.getFollows());
            Assert.Equal(u2.getUsername(), userList[0].getUsername());
        }

        [Fact]
        public void testGetUser()
        {
            followList list = new followList();
            User u1 = new User(1, "Shafer", "Hess", "shafer_", "shafer.hess01@gmail.com", "testPass");
            User u2 = new User(2, "Test", "User", "tester_", "test_valid@gmail.com", "password");
            
            list.addFollow(u1);
            list.addFollow(u2);

            User newUser = list.getUser(u1);
            
            Assert.Equal(u1.getUsername(), newUser.getUsername());
        }

        [Fact]
        public void testGetAndSetFollows()
        {
            //Test getFollows()
            followList list = new followList();
            User u1 = new User(1, "Shafer", "Hess", "shafer_", "shafer.hess01@gmail.com", "testPass");
            User u2 = new User(2, "Test", "User", "tester_", "test_valid@gmail.com", "password");
            
            list.addFollow(u1);
            list.addFollow(u2);

            int follows = list.getFollows();
            Assert.Equal(2, follows);
            
            //Test setFollows()
            followList list2 = new followList();
            list2.setFollows(20);
            
            Assert.Equal(20, list2.getFollows());
        }   
    }
}