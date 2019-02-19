using System;
using System.Collections;
using System.Collections.Generic;
using System.Text;
namespace Test
{
    #region Employee
    public class Employee
    {
        #region Member Variables
        protected int _employee_ID;
        protected int _firstname;
        protected string _address;
        protected string _gender;
        protected unknown _updated_at;
        #endregion
        #region Constructors
        public Employee() { }
        public Employee(int firstname, string address, string gender, unknown updated_at)
        {
            this._firstname=firstname;
            this._address=address;
            this._gender=gender;
            this._updated_at=updated_at;
        }
        #endregion
        #region Public Properties
        public virtual int Employee_ID
        {
            get {return _employee_ID;}
            set {_employee_ID=value;}
        }
        public virtual int Firstname
        {
            get {return _firstname;}
            set {_firstname=value;}
        }
        public virtual string Address
        {
            get {return _address;}
            set {_address=value;}
        }
        public virtual string Gender
        {
            get {return _gender;}
            set {_gender=value;}
        }
        public virtual unknown Updated_at
        {
            get {return _updated_at;}
            set {_updated_at=value;}
        }
        #endregion
    }
    #endregion
}