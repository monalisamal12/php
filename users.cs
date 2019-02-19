using System;
using System.Collections;
using System.Collections.Generic;
using System.Text;
namespace Test
{
    #region Users
    public class Users
    {
        #region Member Variables
        protected int _id;
        protected string _firstname;
        protected string _lastname;
        protected string _email;
        protected string _DOB;
        protected string _address;
        protected int _role;
        protected string _activation_otp;
        #endregion
        #region Constructors
        public Users() { }
        public Users(string firstname, string lastname, string email, string DOB, string address, int role, string activation_otp)
        {
            this._firstname=firstname;
            this._lastname=lastname;
            this._email=email;
            this._DOB=DOB;
            this._address=address;
            this._role=role;
            this._activation_otp=activation_otp;
        }
        #endregion
        #region Public Properties
        public virtual int Id
        {
            get {return _id;}
            set {_id=value;}
        }
        public virtual string Firstname
        {
            get {return _firstname;}
            set {_firstname=value;}
        }
        public virtual string Lastname
        {
            get {return _lastname;}
            set {_lastname=value;}
        }
        public virtual string Email
        {
            get {return _email;}
            set {_email=value;}
        }
        public virtual string DOB
        {
            get {return _DOB;}
            set {_DOB=value;}
        }
        public virtual string Address
        {
            get {return _address;}
            set {_address=value;}
        }
        public virtual int Role
        {
            get {return _role;}
            set {_role=value;}
        }
        public virtual string Activation_otp
        {
            get {return _activation_otp;}
            set {_activation_otp=value;}
        }
        #endregion
    }
    #endregion
}