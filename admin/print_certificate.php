<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Print Certificate Example</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <!-- Bootstrap CSS -->
    <style>
      /* Styles for the certificate */
      .certificate {
        padding: 20px;
        border: 1px solid #000;
        width: 600px; /* Adjust width as needed */
        margin: auto; /* Center the certificate */
        text-align: center;
      }
      /* Styles specifically for printing */
      @media print {
        body * {
          visibility: hidden;
        }
        .certificate,
        .certificate * {
          visibility: visible;
        }
        .certificate {
          position: absolute;
          left: 0;
          top: 0;
          width: 100%; /* Full width for printing */
        }
      }
    </style>
  </head>
  <body>
    <div class="container text-center mt-5">
      <h1>Certificate Management System</h1>
      <button id="printButton" class="btn btn-primary">
        Print Certificate
      </button>
    </div>

    <script>
      document.getElementById("printButton").onclick = function () {
        // Open a new window for the certificate
        var printWindow = window.open("", "_blank");
        printWindow.document.write("<!DOCTYPE html>");
        printWindow.document.write('<html lang="en">');
        printWindow.document.write("<head>");
        printWindow.document.write('<meta charset="UTF-8">');
        printWindow.document.write(
          '<meta name="viewport" content="width=device-width, initial-scale=1.0">'
        );
        printWindow.document.write("<title>Certificate Preview</title>");
        printWindow.document.write("<style>");
        printWindow.document.write(
          ".certificate { padding: 20px; border: 1px solid #000; width: 600px; margin: auto; text-align: center; }"
        );
        printWindow.document.write(
          "@media print { body * { visibility: hidden; } .certificate, .certificate * { visibility: visible; } .certificate { position: absolute; left: 0; top: 0; width: 100%; } }"
        );
        printWindow.document.write("</style>");
        printWindow.document.write("</head>");
        printWindow.document.write("<body>");
        printWindow.document.write('<div class="certificate">');
        printWindow.document.write("<h1>Certificate of Achievement</h1>");
        printWindow.document.write("<p>This is to certify that</p>");
        printWindow.document.write("<h2><strong>John Doe</strong></h2>");
        printWindow.document.write(
          "<p>Has successfully completed the course</p>"
        );
        printWindow.document.write(
          "<h3><strong>Web Development 101</strong></h3>"
        );
        printWindow.document.write(
          "<p>On this day, <strong>October 21, 2024</strong></p>"
        );
        printWindow.document.write("<p>____________________</p>");
        printWindow.document.write("<p>Signature</p>");
        printWindow.document.write("</div>");
        printWindow.document.write("</body>");
        printWindow.document.write("</html>");

        printWindow.document.close(); // Close the document to render it
        printWindow.focus(); // Bring focus to the new window
        printWindow.print(); // Automatically open the print dialog
        printWindow.close(); // Optional: close the print window after printing
      };
    </script>
  </body>
</html>
