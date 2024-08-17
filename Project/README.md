# Database Management Project

This project focuses on managing records in various tables using a PHP-based application. The application supports adding, deleting, searching, and displaying records in a MySQL database. It is designed to run on an Apache server in a local development environment.

## Project Overview

The project includes the following key functionalities:

1. **Adding New Records**: Ability to insert new records into the specified table.
2. **Deleting Records**: Ability to remove records from the specified table.
3. **Searching Records**: Ability to search for records within the specified table.
4. **Displaying Tables**: Ability to display all records from the specified table.

## Features

- **Single PHP File Implementation**: All functionalities are implemented in a single PHP file.
- **HTML Structure**: The application uses a basic HTML structure with a `head` section for the page title and a `body` section for forms and process handling.
- **Validation**: Ensures that all required fields are filled before performing operations.
- **Dynamic Handling**: Different sections for adding, deleting, searching, and displaying records are similar in design but vary in their specific operations and fields.

## How It Works

1. **Database Connection**:
   - Establishes a connection to the MySQL database using provided credentials.
   - In case of connection issues, an error message is displayed.

2. **Add Record**:
   - Users fill out a form to add a new record.
   - If all required fields are filled, the record is either inserted as a new entry or updated if the primary key already exists.

3. **Delete Record**:
   - Users specify identifiers to delete a record.
   - The application checks if the identifiers exist and removes the record if valid. If not, a "Record not found" message is displayed.

4. **Search Record**:
   - Users provide search criteria to find records.
   - The application queries the table and displays matching results. If no records match, a "Record not found" message is shown.

5. **Display Table**:
   - Retrieves and displays all records from a specified table in a tabular format.

## Setup and Usage

1. **Clone the Repository**:
   To access the files locally, clone the repository using:
   ```bash
   git clone https://github.com/your-username/DataBase_Management_Project.git
