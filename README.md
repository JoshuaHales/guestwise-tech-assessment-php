<img width="300" alt="image" src="https://github.com/user-attachments/assets/1de0151b-8aa1-4570-b49d-1ffb6c37e13b">

# Guestwise Technical Assessment

## Technical Test Brief

### Objective

Your task is to continue, and possibly complete, a partially built Laravel application.

The application models marketing campaigns for restaurant brands. Each campaign has data related to **Impressions**, **Interactions**, and **Conversions**.

Currently, the application has a campaign index page that lists all campaigns, but it has some missing functionality:

-   It should be possible to filter by Brand using the Brand dropdown.
-   It should be possible to sort and order each of the columns by clicking them (or the arrows).
-   The table should show the number of Impressions, Interactions and Conversions in their associated columns.
-   The number of impressions, interactions and conversions should be correct for the date range filtered (default is last 7 days).
-   The page should load be performant and load quickly, regardless of page, filters and sorting.

Your task is to enhance this page to rectify these issues and ensure that the page is performant and loads quickly.

### Requirements

-   You will be working with three main models: **Impression**, **Interaction**, and **Conversion**. Each of these is associated with both a **Campaign** and a **Brand**.
-   The application will be seeded with the following data:
    -   **10 Restaurant Brands**
    -   **10 Campaigns** per brand
    -   Each campaign will have:
        -   **Several hundred thousand** Impressions over 30 days
        -   About **~27,000 Interactions** over 30 days
        -   About **~2,700 Conversions** over 30 days
-   The list view should include the following columns:
    -   **Campaign Name**
    -   **Brand Name**
    -   **Impressions**
    -   **Interactions**
    -   **Conversions**
    -   **Conversion Rate** (calculated as Conversions ÷ Interactions)
-   The view should be optimised to handle large datasets efficiently, even with filters and ordering applied.

### Evaluation Criteria

-   **Code Quality**: Is the code well-organised and easy to understand?
-   **Performance**: Does the view load in under 300ms when filtered and sorted?
-   **Functionality**: Does the application meet the requirements, including filtering, ordering, and date range adjustment?
-   **Best Practices**: Are Laravel and PHP best practices followed (e.g., query optimisation, use of Eloquent relationships, Blade templating)?

---

## Setup Instructions

### Prerequisites

-   **Docker**: Ensure that Docker is installed and running on your system.
-   **Composer**: Ensure Composer is installed (https://getcomposer.org/).

### Steps

1. **Fork & Clone the repository**:

    ```bash
    git clone <repository_url>
    cd <repository_directory>
    ```

2. **Install dependencies**:

    ```bash
    composer install
    ```

3. **Setup environment variables**:
   Copy the `.env.example` file and create a new `.env` file.

    ```bash
    cp .env.example .env
    ```

4. **Update .env**:
   Set up the necessary environment variables such as **database connection** and **Laravel Sail settings**.

5. **Start Laravel Sail**:

    ```bash
    ./vendor/bin/sail up
    ```

6. **Generate an application key**:

    ```bash
    ./vendor/bin/sail artisan key:generate
    ```

7. **Run the database migrations**:

    ```bash
    ./vendor/bin/sail artisan migrate
    ```

8. **Seed the database**:
   The seeder will populate the database with 10 restaurant brands, each with 10 campaigns, along with impressions, interactions, and conversions data.

    This will take some time due to the large volume of data being generated. Approximately 10 minutes. Boil the kettle and make a cup of tea or coffee while you wait. If you're feeling adventurous, you can try to optimise the seeder to run faster.

    ```bash
    ./vendor/bin/sail artisan db:seed
    ```

9. **Access the application**:
   Once the Sail container is running, you should be able to access the application at `http://localhost`.

   You should see something like:
   <img width="1800" alt="image" src="https://github.com/user-attachments/assets/5c0cf223-2630-4992-a422-9ba666646cb6">

---

## Evaluation Process

1. **Functional Requirements**:

    - The Blade view should be able to display all campaigns with correct metrics.
    - The list should update based on the selected date range and restaurant brand filter.
    - The data should be sortable by Campaign Name, Brand Name, Impressions, Interactions, Conversions, and Conversion Rate.
    - The number of Impressions, Interactions, and Conversions should be correct for the date range filtered.
    - The Conversion Rate should be calculated as Conversions ÷ Impressions.
    - The view should be optimised to handle large datasets efficiently.

2. **Performance**:

    - The view should load in less than 300ms despite the large dataset.
    - Optimised querying and indexing strategies should be implemented where necessary.

3. **Code Review**:

    - We will review your code for clarity, structure, and adherence to Laravel best practices.
    - Efficient use of Eloquent, relationships, and query optimisation will be critical.

4. **Bonus Points**:

    - Regular commits with clear commit messages, demonstrating your thought process and approach.
    - Any additional improvements that enhance the performance or functionality beyond the brief will be appreciated.

5. **Submission**:
    - Once you have completed the task, please commit your changes and push them to a forked repository and share the link with us.
    - We'll then arrange a follow-up call to discuss your solution and answer any questions you may have.

## Good To Know

-   The Sail install includes Redis, feel free to use it for caching or any other purpose.
-   The database is seeded with a large volume of data, so you may need to optimise your queries and indexing strategies.

Good luck, and happy coding!
