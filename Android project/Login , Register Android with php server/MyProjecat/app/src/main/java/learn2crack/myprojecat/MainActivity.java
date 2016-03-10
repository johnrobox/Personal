package learn2crack.myprojecat;

import android.annotation.TargetApi;
import android.content.Context;
import android.content.Intent;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.Build;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.text.Html;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;

public class MainActivity extends AppCompatActivity {

    RequestQueue requestQueue;
    EditText userEmail, userPassword;
    Button login;
    TextView displayError, register;
    String url = "http://192.168.0.158/LoginLogout/loginUser.php";
    public static final String MyPREFERENCES = "MyPrefs" ;
    public static final String token = "tokenKey";

    // User Session Manager Class
    UserSessionManager session;


    @TargetApi(Build.VERSION_CODES.M)
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        HttpsTrustManager.allowAllSSL();

        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);


        isOnline();


        // user session manager
        session =  new UserSessionManager(getApplicationContext());

        userEmail = (EditText) findViewById(R.id.userEmail);
        userPassword = (EditText) findViewById(R.id.userPassword);
        login = (Button) findViewById(R.id.login);
        displayError = (TextView) findViewById(R.id.displayError);

        register = (TextView) findViewById(R.id.register);
        register.setTextColor(getResources().getColor(R.color.colorPrimary, null));
        register.setText(Html.fromHtml("<u>DONT HAVE ACCOUNT ?</u>"));

        requestQueue = Volley.newRequestQueue(getApplicationContext());

        // if Login button is click
        login.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                HashMap<String, String> params = new HashMap<String, String>();
                params.put("email", userEmail.getText().toString());
                params.put("password", userPassword.getText().toString());

                JsonObjectRequest request = new JsonObjectRequest(Request.Method.POST, url, new JSONObject(params), new Response.Listener<JSONObject>() {

                    public void onResponse(JSONObject response) {
                        try {
                            if (response.has("error")) {
                                JSONObject err = response.getJSONObject("error");
                                String error = err.getString("message");
                                Toast.makeText(getApplicationContext(), error, Toast.LENGTH_LONG).show();

                            } else if (response.has("token")) {
                                String users_api_token = response.getString("token");
                                session.createUserLoginSession(users_api_token);

                                Intent i = new Intent(MainActivity.this, HomeActivity.class);
                                i.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);

                                // Add new Flag to start new Activity
                                i.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                                startActivity(i);

                                finish();
                            }
                        } catch (JSONException e) {
                            e.printStackTrace();

                        }
                    }

                }, new Response.ErrorListener() {
                    public void onErrorResponse(VolleyError error) {

                    }
                });
                requestQueue.add(request);
            }
        });

        // if dont have account is click
        register.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent gotoRegisterPage = new Intent(MainActivity.this, RegisterActivity.class);
                startActivity(gotoRegisterPage);
            }
        });

    }

    @Override
    protected void onResume() {
        super.onResume();
        // Check if session is true and will redirect to homepage
        if (session.isUserLoggedIn()) {
            Intent gotoPage = new Intent(getApplicationContext(), HomeActivity.class);
            startActivity(gotoPage);
        }
    }

    protected boolean isOnline() {
        ConnectivityManager cm = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo netInfo = cm.getActiveNetworkInfo();
        if (netInfo != null && netInfo.isConnected()) {
            Toast.makeText(getApplicationContext(), "You are connected to a network", Toast.LENGTH_LONG).show();
            return true;
        } else {
            Toast.makeText(getApplicationContext(), "No internet connection", Toast.LENGTH_LONG).show();
            return false;
        }
    }
}
