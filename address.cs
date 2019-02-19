using System;
using System.Collections;
using System.Collections.Generic;
using System.Text;
namespace Test
{
    #region Address
    public class Address
    {
        #region Member Variables
        protected int _id;
        protected string _employee_id;
        protected string _address;
        #endregion
        #region Constructors
        public Address() { }
        public Address(string employee_id, string address)
        {
            this._employee_id=employee_id;
            this._address=address;
        }
        #endregion
        #region Public Properties
        public virtual int Id
        {
            get {return _id;}
            set {_id=value;}
        }
        public virtual string Employee_id
        {
            get {return _employee_id;}
            set {_employee_id=value;}
        }
        public virtual string Address
        {
            get {return _address;}
            set {_address=value;}
        }
        #endregion
    }
    #endregion
}