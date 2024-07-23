## About CompanyConnect

CompanyConnect is a website for listing the companies and employees under that companies. You can can add, view, edit and
delete the companies and employees under that company. Also there is an Api for getting the employee details.

## Company Connect Api's

- Base Url: https://api.example.com/v1
- Login: 
    - Endpoint: /v1/login
    - Method: POST,
    - Description: Retrieve authenticated user token.
    - Headers: <pre>{
        Accept: application/json
    }</pre>
    - Body Params (JSON) : <pre>{
        "email": "admin@admin.com",
        "password": password"
    }</pre>
    - Success Response:
        - Code: 200
        - Content: <pre>{
            "token": "1|pdAagPqaQxHoPRmEv8muFVdy5xaaI3cHBs978Ozy"
        }</pre>
    - Error Response:
        - Code: 401
        - Content: <pre>{
            "error": "You are not authorized to access this Api"
        }</pre>
- Employees Details: 
    - Endpoint: /v1/employees
    - Method: GET,
    - Description: Retrieve all employees data after successful login.
    - Authorization: Bearer token
    - Headers: <pre>{
        Accept: application/json
    }</pre>
    - Success Response:
        - Code: 200
        - Content: <pre>[
            <pre>{
                "id": 1,
                "first_name": "test",
                "last_name": "employee",
                "email": "testemployee@gmail.com",
                "phone": "9878987898",
                "company_details": {
                    "id": 1,
                    "name": "Benz",
                    "email": "benz@gmail.com",
                    "logo": "{base_url}/company/logo/1721671895_xrBpbDTCqo_benz_logo.png",
                    "website": "http://www.google.com"
                }
            }</pre>
        ]</pre>
    - Error Response:
        - Code: 401
        - Content: <pre>{
            "error": "Unauthenticated"
        }</pre>

