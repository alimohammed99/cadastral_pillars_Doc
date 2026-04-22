  .tab-content {
  margin-top: 20px;
  }

  .table thead th {
  background-color: #f4f4f4;
  color: #333;
  }

  .table-striped tbody tr:nth-of-type(odd) {
  background-color: #f9f9f9;
  }

  .modal-content {
  padding: 20px;
  }

  th {
  text-transform: uppercase;
  }

  /* Tab navigation styling */
  .nav-tabs {
  border-bottom: 2px solid #dee2e6;
  }

  .nav-tabs .nav-link {
  border: 1px solid #dee2e6;
  border-radius: 0.25rem;
  margin-right: -1px;
  background-color: #f8f9fa;
  padding: 10px 15px;
  color: #495057;
  font-weight: 500;
  }

  .nav-tabs .nav-link.active {
  background-color: #ffffff;
  border-color: #dee2e6 #dee2e6 #ffffff;
  color: #007bff;
  }

  .nav-tabs .nav-link:hover {
  background-color: #e9ecef;
  }



  {{-- Media queries --}}
  /* For small screens like mobile */
  @media (max-width: 768px) {
  .flex {
  justify-content: center;
  /* Center the button and input */
  flex-direction: column;
  /* Stack them on top of each other */
  align-items: center;
  }

  .flex button,
  .flex .btn {
  width: 100%;
  /* Make button take full width */
  margin-bottom: 10px;
  /* Add some space below the button */
  }

  .search-input {
  width: 100%;
  /* Make search input take full width */
  }
  }

  /* For extra small screens (mobile) */
  @media (max-width: 576px) {
  .flex {
  justify-content: center;
  /* Keep them centered */
  flex-direction: column;
  /* Stack them on top of each other */
  align-items: center;
  }

  .flex button,
  .search-input {
  width: 90%;
  /* Reduce width for smaller screens */
  }
  }
