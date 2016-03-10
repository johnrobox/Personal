package learn2crack.myprojecat;

import android.annotation.TargetApi;
import android.content.Intent;
import android.os.Build;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.text.Html;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;

/**
 * Created by su004 on 2/3/2016.
 */
public class RegisterActivity extends AppCompatActivity {

    RequestQueue requestQueue;
    EditText firstname, lastname, email, password, confirmPassword;
    Button clear, register;
    TextView displayMessage, back;
    String url = "http://192.168.0.158/LoginLogout/registerUser.php";

    protected void onCreate(Bundle savedInstanceState) {
        HttpsTrustManager.allowAllSSL();
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);

        register = (Button) findViewById(R.id.register);
        clear = (Button) findViewById(R.id.clear);

        firstname = (EditText) findViewById(R.id.firstnameLabel);
        lastname = (EditText) findViewById(R.id.lastnameLabel);
        email = (EditText) findViewById(R.id.emailLabel);
        password = (EditText) findViewById(R.id.password);
        confirmPassword = (EditText) findViewById(R.id.confirmPassword);
        displayMessage = (TextView) findViewById(R.id.displayMessage);
        back = (TextView) findViewById(R.id.back);

        requestQueue = Volley.newRequestQueue(getApplicationContext());

        // if clear button is clicked
        clear.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                clearField();
            }
        });

        // if back is click
        back.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                gotoLogin();
            }
        });

        // if register button is click
        register.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                HashMap<String, String> params = new HashMap<String, String>();
                params.put("firstname", firstname.getText().toString());
                params.put("lastname", lastname.getText().toString());
                params.put("email", email.getText().toString());
                params.put("password", password.getText().toString());
                params.put("confirmPassword", confirmPassword.getText().toString());

                JsonObjectRequest request = new JsonObjectRequest(Request.Method.POST, url, new JSONObject(params), new Response.Listener<JSONObject>() {

                    @TargetApi(Build.VERSION_CODES.M)
                    public void onResponse(JSONObject response) {
                        try {
                            if ( response.has("error") ) {
                                JSONObject err = response.getJSONObject("error");
                                String error = err.getString("message");
                                displayMessage.setTextColor(getResources().getColor(R.color.error, null));
                                displayMessage.setText(error);

                            } else if (response.has("created")) {
                                clearField();
                                displayMessage.setTextColor(getResources().getColor(R.color.success, null));
                                displayMessage.setText(Html.fromHtml("Your account successfully created. <br><u>CLICK HERE TO LOGIN.</u>"));

                                displayMessage.setOnClickListener(new View.OnClickListener() {
                                    @Override
                                    public void onClick(View v) {
                                        gotoLogin();
                                    }
                                });
                            }
                        } catch (JSONException e) {
                            e.printStackTrace();

                        }
                    }

                }, new Response.ErrorListener(){
                    public void onErrorResponse(VolleyError error) {

                    }
                });
                requestQueue.add(request);
            }
        });


    }


    // Clear all field in registration
    public void clearField (){
        firstname.setText("");
        lastname.setText("");
        email.setText("");
        password.setText("");
        confirmPassword.setText("");
        displayMessage.setText("");
    }


    // Back to login screen
    public void gotoLogin() {
        Intent login =  new Intent(RegisterActivity.this, MainActivity.class);
        startActivity(login);
    }



}
